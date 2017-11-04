<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 02.11.2017
 * Time: 14:08
 */

require_once ("../vendor/autoload.php");
$app = new crudExample\App();
$app->init();
$main = new crudExample\controllers\main($app);
$main->requestAll();