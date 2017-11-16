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
use crudExample\View;

class userlist extends Controller
{

    public function requestParams()
    {
        $this->params = $_REQUEST;
        if (isset ($_REQUEST['Submit'])) {
            unset($this->params['Submit']);

        }
        $this->data['form'] = $this->params;
        $this->data['applogin'] = $this->app->login;
        return $this;
    }

    public function requestData()
    {
        $orders = [];
        $fields1 = [];
        $fields2 = [];
        foreach ($this->params as $name => $field) {
            if ($name == 'clogin') $orders[] = 'login';
            if ($name == 'cfio') $orders[] = 'fio';
            if ($name == 'crights') $orders[] = 'rights';
            if ($name == 'login' AND !empty($field)) $fields1['login'] = $field;
            if ($name == 'fio' AND !empty($field)) $fields1['fio'] = $field;
            if ($name == 'rights' AND ($field != '')) {
                $fields2['rights'] = $field;
            }
        }

        $base = new UserOps($this->app);
        $table = $base->listFO($orders, $fields1, $fields2);
        $this->data['table'] = $table;
        return $this;
    }

}