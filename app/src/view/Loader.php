<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 02.11.2017
 * Time: 13:00
 */

namespace crudExample\view;


class Loader
{
    public function __construct($app, $name, $params)
    {
        $templateFile = $app->root.DIRECTORY_SEPARATOR.$app->templateDir.DIRECTORY_SEPARATOR.$name.'.inc';
        extract($params);
        include $templateFile;
    }
}