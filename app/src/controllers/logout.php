<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 12:20
 */

namespace crudExample\controllers;
use crudExample\Controller;
use crudExample\model\Authorize;

class logout extends Controller
{
    public function requestData()
    {

        Authorize::removeAuth();
        header("Location:/");
        exit();

    }
}