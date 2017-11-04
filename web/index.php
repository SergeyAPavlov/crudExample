<?php
require_once ("../vendor/autoload.php");
$app = new crudExample\App();
$app->init();
$main = new crudExample\controllers\main($app);
$main->requestAll();