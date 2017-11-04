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

class userupdate extends Controller
{
    public function requestParams()
    {
        $this->data['userid'] = $_REQUEST['id'];
        $base = new UserOps($this->app);
        $fields = $base->read($this->data['userid'])->fields;
        if ($fields['login'] != $this->app->login) {
            header("Location:/none");
            exit();
        }
        if (isset ($_REQUEST['Submit'])) {
            $this->params = $_REQUEST;
            unset($this->params['Submit']);
            unset($this->params['rights']);
            unset($this->params['login']);

            $base->fields = $this->params;
            $base->update();
        }
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