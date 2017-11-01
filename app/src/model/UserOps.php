<?php
/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 17:57
 */

namespace crudExample\Model;


use crudExample\App;

/**
 * Class UserOps
 * @package crudExample\Model
 */
class UserOps
{
    public $fields;
    public $done;
    public $errors;

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

        $query = 'SELECT * from '.$this->table." WHERE `id` = '".$id."'";
        /** @var \mysqli_result $result */
        $result = $this->db->query($query);
        if (empty($result)){
            $this->done = false;
            $this->errors = $this->db->error_list;
            return $this;
        }
        $fields = $result->fetch_assoc();
        $this->fields = $fields;
        $this->done = true;
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

        /** @var \mysqli_result $result */
        $result = $this->db->query($query);
        $this->done = true;
        if (empty($result)) {
            $this->done = false;
            $this->errors = $this->db->error_list;
        }
        return $this;

    }
    /**
     * @param bool|array $fields
     * @return $this
     */
    public function update($fields = false)
    {
        if ($fields === false){
            $fields = $this->fields;
        }
        else {
            $this->fields = $fields;
        }
        if (!is_array($fields)){
            $this->done = false;
            $this->errors = 'Данные для обновляемого пользователя не заданы';
            return $this;
        }
        $keys = array_keys($fields);

        $values = '';
        foreach ($fields as $key=>$value){
            $values .= "`$key`='$value',";
        }
        $values = mb_substr($values, 0, mb_strlen($values)-1 );

        $query = 'UPDATE '.$this->table.' SET '.$values."WHERE id='".$fields['id']."'";
            " VALUES ('".implode("', '",$fields )."'".')';

        /** @var \mysqli_result $result */
        $result = $this->db->query($query);
        $this->done = true;
        if (empty($result)) {
            $this->done = false;
            $this->errors = $this->db->error_list;
        }
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
        $result = $this->db->query($query);
        if (empty($result)){
            $this->done = false;
            $this->errors = $this->db->error_list;
            return $this;
        }
        $fields = null;
        $this->fields = $fields;
        $this->done = true;
        return $this;
    }




}