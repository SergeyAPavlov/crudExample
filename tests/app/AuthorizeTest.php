<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 21:43
 */

use crudExample\model\Authorize;
use PHPUnit\Framework\TestCase;
require_once ("../../vendor/autoload.php");

class AuthorizeTest extends TestCase
{

    public function testCheck()
    {
        $app = new crudExample\App();
        $app->init();
        $res = Authorize::checkLogin($app, 'test', 'test');
        $this->assertTrue(!$res);
        $res = Authorize::checkLogin($app, 'user', 'password');
        $this->assertTrue($res);

    }
}
