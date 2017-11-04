<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 22:31
 */

namespace crudExample\controllers;


use crudExample\Controller;
use crudExample\Model\UserOps;
use crudExample\View;

class userlist extends Controller
{

    public function requestParams()
    {
        $this->params = $_REQUEST;
        $this->data['applogin'] = $this->app->login;
        return $this;
    }
    public function requestData()
    {
        $base = new UserOps($this->app);
        $table = $base->listTable();
        $this->data['table'] = $table;
        return $this;
    }

}