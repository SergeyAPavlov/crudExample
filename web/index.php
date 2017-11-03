<pre>
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
$rout = new \crudExample\Router($app);

/*
var_dump($rout);

var_dump($app);
echo "\n";
var_dump($_SERVER);
echo "\n";
var_dump($_SESSION);
echo "\n";
var_dump($_ENV);

*/
