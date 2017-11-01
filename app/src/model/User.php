<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 17:57
 */

namespace crudExample\Model;


use crudExample\App;

/**
 * Class User
 * @package crudExample\Model
 */
class User
{
    public $fields;

    private $db;
    private $app;

    public $table;
    public $emailFieldName = 'email';


    /**
     * User constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->db = $app->getConnection();
        $this->table = $app->usersTable;

    }

    public function read($id)
    {

        $query = 'SELECT * from '.$this->table." WHERE `id` = '".$id."'";
        /** @var \mysqli_result $result */
        $result = $this->db->query($query);
        if (empty($result)) return false;
        $fields = $result->fetch_assoc();
        $this->fields = $fields;
        return $this;

    }

    public function create($fields)
    {
        $keys = array_keys($fields);

        $query = 'INSERT INTO '.$this->table.' (`'.implode('`, `',$keys ).'`) '.
        " VALUES ('".implode("', '",$fields )."'".')';

        /** @var \mysqli_result $result */
        $result = $this->db->query($query);
        if (empty($result)) {
            var_dump($this->db->error_list);
            return false;
        }
        return true;

    }




}