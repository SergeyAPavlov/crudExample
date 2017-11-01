<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 18:44
 */

use crudExample\Model\User;
use PHPUnit\Framework\TestCase;
require_once ("../../vendor/autoload.php");

class UserTest extends TestCase
{

    public function testConstruct()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new User($app);
    }

    public function testRead()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new User($app);
        $fields = $user->read(1)->fields;
    }

    public function testCreate()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new User($app);
        $fields =  ["login"=>'user'.uniqid(), "password"=>"password", "fio"=>'Some FIO', "email"=>'test@test.ru', "rights"=>0];
        $create = $user->create($fields);
        $this->assertTrue($create);
    }

}
