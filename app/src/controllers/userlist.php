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
        $filters = [];
        foreach ($this->params as $name => $field) {
            if ($name == 'clogin') $orders[] = '`login`';
            if ($name == 'cfio') $orders[] = '`fio`';
            if ($name == 'crights') $orders[] = '`rights`';
            if ($name == 'login' AND !empty($field)) $filters[] = "`login` LIKE '%$field%'";
            if ($name == 'fio' AND !empty($field)) $filters[] = "`fio` LIKE '%$field%'";
            if ($name == 'rights' AND ($field != '')) {
                $filters[] = "`rights`='$field'";
            }
        }
        $order = implode(' AND ', $orders);
        if (!empty($order)) $order = ' ORDER BY ' . $order;
        $filter = implode(' AND ', $filters);
        if (!empty($filter)) $filter = ' AND ' . $filter;
        $condition = $filter . $order;
        $this->data['condition'] = $condition;

        $base = new UserOps($this->app);
        $table = $base->listTable($condition);
        $this->data['table'] = $table;
        return $this;
    }

}