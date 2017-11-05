<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 22:31
 */

namespace crudExample\controllers;


use crudExample\Controller;
use crudExample\model\UserOps;

class userread extends Controller
{
    public function requestParams()
    {
        $this->data['userid'] = $_REQUEST['id'];
        return $this;
    }

    public function requestData()
    {
        $base = new UserOps($this->app);
        $fields = $base->read($this->data['userid'])->fields;
        $this->data['fields'] = $fields;
        return $this;
    }
}