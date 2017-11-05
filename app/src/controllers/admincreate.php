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

class admincreate extends Controller
{
    public function requestParams()
    {

        if (isset ($_REQUEST['Submit'])) {
            $this->params = $_REQUEST;
            unset($this->params['Submit']);
            if (isset($this->params['rights'])) {
                $this->params['rights'] = 1;
            } else $this->params['rights'] = 0;
            $base = new UserOps($this->app);
            $base->fields = $this->params;
            $base->create();
            header("Location:/");
            exit();
        }
        return $this;
    }

    public function requestData()
    {
        $base = new UserOps($this->app);
        $fields = $base->listFields();
        $this->data['fields'] = $fields;
        return $this;
    }
}