<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 21:24
 */

namespace crudExample\controllers;


use crudExample\Controller;
use crudExample\model\Authorize;

class register extends Controller
{
    public function requestParams()
    {
        $this->params['login'] = $_REQUEST['login'];
        $this->params['password'] = $_REQUEST['password'];
        return $this;
    }
    public function requestData()
    {
        $params = $this->params;
        $passed = Authorize::checkLogin($this->app, $params['login'], $params['password']);

        if ($passed){
            //echo 'passed';
            Authorize::setAuth($this->app, $params['login']);
        };
        header("Location:/");
        exit();

    }
}