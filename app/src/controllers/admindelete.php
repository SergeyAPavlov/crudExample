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

class admindelete extends Controller
{
    public function requestParams()
    {
        $this->data['userid'] = $_REQUEST['id'];
        if (isset ($_REQUEST['Submit'])) {

            $base = new UserOps($this->app);
            $base->delete($this->data['userid']);
            header("Location:/");
            exit();
        }

        return $this;
    }

}