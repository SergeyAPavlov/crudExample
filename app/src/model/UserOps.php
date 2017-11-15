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
        $opt = array(
            'host' => 'localhost',
            'user' => 'crudTest',
            'pass' => 'crudTest',
            'db' => 'crudTest'
        );
        $db = new \SafeMySQL($opt);
        $query = "SELECT * from $table WHERE $name=?s";
        $row = $db->getRow($query, $field);
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
        $keys = array_keys($fields);

        $query = 'INSERT INTO '.$this->table.' (`'.implode('`, `',$keys ).'`) '.
        " VALUES ('".implode("', '",$fields )."'".')';

        $this->query($query);
        return $this;

    }
    /**
     * @return $this
     */
    public function update()
    {

        $fields = $this->fields;
        if (!is_array($fields)){
            $this->done = false;
            $this->errors = 'Данные для обновляемого пользователя не заданы';
            return $this;
        }

        $values = '';
        foreach ($fields as $key=>$value){
            $values .= "`$key`='$value',";
        }
        $values = mb_substr($values, 0, mb_strlen($values)-1 );
        $query = 'UPDATE '.$this->table.' SET '.$values."WHERE id='".$fields['id']."'";

        $this->query($query);
        return $this;

    }

    /**
     * @param int $id
     * @return $this
     */
    public function delete($id)
    {
        $query = 'DELETE from '.$this->table." WHERE `id` = ".$id;
        /** @var \mysqli_result $result */

        $this->query($query);
        $this->fields = null;
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
        /** @var \mysqli_result $result */
        $result = $this->query($query);
        while ($fields = $result->fetch_assoc()) {
            $this->fields[] = $fields['Field'];
        }
        return $this->fields;
    }


}