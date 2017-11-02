<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 02.11.2017
 * Time: 13:41
 */

use crudExample\view\Loader;
use PHPUnit\Framework\TestCase;
require_once ("../../vendor/autoload.php");
class LoaderTest extends TestCase
{

    public function testIt()
    {
        $app = new crudExample\App();
        $app->init();
        $load = new Loader($app, 'test', ['t1'=>'поле']);
    }
}
