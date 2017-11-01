<?php
/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 18:44
 */

use crudExample\Model\UserOps;
use PHPUnit\Framework\TestCase;
require_once ("../../vendor/autoload.php");

class UserTest extends TestCase
{

    public function testConstruct()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new UserOps($app);
    }

    public function testRead()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new UserOps($app);
        $fields = $user->read(1)->fields;
        $this->assertTrue($user->done);
    }

    public function testCreate()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new UserOps($app);
        $fields =  ["login"=>'user'.uniqid(), "password"=>"password", "fio"=>'Some FIO', "email"=>'test@test.ru', "rights"=>0];
        $create = $user->create($fields);
        $this->assertTrue($create->done);
    }

    public function testFalseCreate()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new UserOps($app);
        $fields =  ["login"=>'user', "password"=>"password", "fio"=>'Some FIO', "email"=>'test@test.ru', "rights"=>0];
        $create = $user->create($fields);
        $this->assertFalse($create->done);
    }

    public function testUpdate()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new UserOps($app);
        $fields =  ['id'=>2, "login"=>'user'.uniqid(), "password"=>"password", "fio"=>'Some FIO', "email"=>'test@test.ru', "rights"=>0];
        $create = $user->update($fields);
        $this->assertTrue($create->done);
    }

    public function testDelete()
    {
        $app = new crudExample\App();
        $app->initBase();
        $user = new UserOps($app);
        $delete = $user->delete(5);
        $this->assertTrue($delete->done);
    }

}
