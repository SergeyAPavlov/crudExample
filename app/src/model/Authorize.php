<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 11:52
 */

namespace crudExample\model;


use crudExample\App;

class Authorize
{
    public static function check(App $app)
    {
        $app->logged = false;
        return false;
    }


}