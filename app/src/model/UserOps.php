<?php
/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 17:57
 */

namespace crudExample\model;

use crudExample\App;

/**
 * Class UserOps
 * @package crudExample\model
 */
class UserOps
{
    public $fields;
    public $done;
    public $errors;
    public $log;

    /** @var \mysqli */
    private $db;
    private $app;

    public $table;
    public $emailFieldName = 'email';


    /**
     * UserOps constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->db = $app->getConnection();
        $this->table = $app->usersTable;

    }

    /**
     * @param int $id
     * @return $this
     */
    public function read($id)
    {
        return $this->find('id', $id);
    }

    /**
     * @param string $name
     * @param string $field
     * @throws \Throwable
     * @return $this
     */

    public function find($name, $field)
    {
        $table = $this->table;
        $this->done = false;

        $db = $this->app->getSafe();
        $query = "SELECT * from $table WHERE ?n=?s";
        $row = $db->getRow($query, $name, $field);
        if (is_array($row)) {
            $this->done = true;
            $this->fields = $row;
        }
        return $this;
    }

    /**
     * @param bool|array $fields
     * @return $this
     */

    public function create($fields = false)
    {
        if ($fields === false){
            $fields = $this->fields;
        }
        else {
            $this->fields = $fields;
        }
        if (!is_array($fields)){
            $this->done = false;
            $this->errors = 'Данные для создаваемого пользователя не заданы';
            return $this;
        }
        $db = $this->app->getSafe();

        $sql = 'INSERT INTO ' . $this->table . ' SET ?u';
        $db->query($sql, $fields);

        $affected = $db->affectedRows();

        if (empty($affected)) {
            $this->done = false;
            $this->errors = 'Запрос на создание пользователя не удался';
        } else {
            $this->done = true;
        }
        return $this;

    }


    /**
     * @return $this
     */
    public function update()
    {

        $fields = $this->fields;
        if (!is_array($fields)){
            $this->done = null;
            $this->errors = 'Данные для обновляемого пользователя не заданы';
            return $this;
        }

        $db = $this->app->getSafe();
        $sql = 'UPDATE ' . $this->table . ' SET ?u WHERE id = ?i';
        $db->query($sql, $fields, $fields['id']);
        $affected = $db->affectedRows();

        if (empty($affected)) {
            $this->done = null;
            $this->errors = 'Запрос на обновление пользователя не удался';
        } else {
            $this->done = true;
        }
        return $this;

    }

    /**
     * @param int $id
     * @return $this
     */
    public function delete($id)
    {
        $query = 'DELETE FROM ' . $this->table . " WHERE `id` = ?i";
        $db = $this->app->getSafe();
        $db->query($query, $id);
        $this->fields = null;
        $affected = $db->affectedRows();
        if (empty($affected)) {
            $this->done = null;
            $this->errors = 'Запрос на обновление пользователя не удался';
        } else {
            $this->done = true;
        }
        return $this;
    }

    /**
     * @param string $query
     * @return null|\mysqli_result
     */
    public function query($query)
    {
        $this->app->logIt($query, 'query', 0);
        $flagFail = false;
        try {
            $result = $this->db->query($query);
        } catch (\Throwable $t)
        {
            $flagFail = true;
        }

        if (empty($result) OR !empty($flagFail)){
            $result = null;
            $this->done = false;
            $this->errors = $this->db->error_list;
            //$this->log[] = ['fail', $this->done, $this->errors, ($flagFail? $t : '')];
            $this->app->logIt($this->errors, 'query_errors', 1);
            if ($flagFail) $this->app->logIt($t, 'query_exeptions', 1);
        }
        else {
            $this->done = true;
        }
        return $result;
    }

    /**
     * @param string $condition
     * @return array
     */
    public function listTable($condition = '')
    {
        if (empty($condition)) {
            $condition = '1=1';
        } else {
            $condition = '1=1' . $condition;
        }
        $query = 'SELECT * from '.$this->table." WHERE ".$condition;
        /** @var \mysqli_result $result */
        $result = $this->query($query);
        $table = [];
        if (empty($result)) return null;
        while ($row = $result->fetch_assoc()){
            $table[] = $row;
        }
        return $table;
    }

    /**
     * @return []
     */
    public function listFields()
    {
        $query = 'SHOW FIELDS FROM ' . $this->table;

        $db = $this->app->getSafe();
        /** @var \mysqli_result $result */
        $result = $db->query($query);
        while ($fields = $result->fetch_assoc()) {
            $this->fields[] = $fields['Field'];
        }
        $this->done = is_array($this->fields) AND !empty($this->fields);
        return $this->fields;
    }

    public function makeSoftFilter($fields)
    {
        $where = '';
        $db = $this->app->getSafe();
        $qw = [];
        foreach ($fields as $name => $value) {
            $like = "%$value%";
            $qw[] = $db->parse("?n LIKE ?s ", $name, $like);
        }
        if (count($qw)) $where = implode(' AND ', $qw);
        return $where;
    }

    public function makeSharpFilter($fields)
    {
        $where = '';
        $db = $this->app->getSafe();
        $qw = [];
        foreach ($fields as $name => $value) {
            $qw[] = $db->parse("?n = ?s ", $name, $value);
        }
        if (count($qw)) $where = implode(' AND ', $qw);
        return $where;
    }

    public function composeWhere($filters)
    {
        $res[0] = ' WHERE 1=1 ';
        foreach ($filters as $filter) {
            if (!empty($filter)) $res[] = $filter;
        }
        return implode(' AND ', $res);
    }

    public function composeOrder($orders)
    {
        $where = '';
        $db = $this->app->getSafe();
        $qw = [];
        foreach ($orders as $value) {
            $qw[] = $db->parse("?n", $value);
        }
        if (count($qw)) $where = implode(' AND ', $qw);
        if ($where) $where = 'ORDER BY ' . $where;
        return $where;
    }

    public function listFiltered($orders, $filters)
    {
        $db = $this->app->getSafe();

        $where = $this->composeWhere($filters);
        $order = $this->composeOrder($orders);

        $query = 'SELECT * from ' . $this->table . $where . $order;
        /** @var \mysqli_result $result */
        $result = $db->query($query);
        $table = [];
        if (empty($result)) return null;
        while ($row = $result->fetch_assoc()) {
            $table[] = $row;
        }
        return $table;
    }

    public function listFO($orders = [], $softFields = [], $sharpFields = [])
    {

        $filter1 = $this->makeSoftFilter($softFields);
        $filter2 = $this->makeSharpFilter($sharpFields);
        return $this->listFiltered($orders, [$filter1, $filter2]);

    }

}