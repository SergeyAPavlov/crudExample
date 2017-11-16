<?php
/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 18:44
 */

use crudExample\model\UserOps;
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
        $app->init();
        $user = new UserOps($app);
        $fields = $user->read(1)->fields;
        $this->assertTrue($user->done);
        $this->assertEquals($fields['login'], 'admin');
    }

    public function testCreate()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $fields = ["login" => 'buser' . uniqid(), "password" => "password", "fio" => 'More Some FIO', "email" => 'rtest@test.ru', "rights" => 0];
        $create = $user->create($fields);
        $this->assertTrue($create->done);
    }


    public function testFalseCreate()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $fields =  ["login"=>'user', "password"=>"password", "fio"=>'Some FIO', "email"=>'test@test.ru', "rights"=>0];
        try {
            $user->create($fields);
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }

        $this->assertNull($user->done);
    }

    public function testUpdate()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $user->fields =  ['id'=>2, "login"=>'user'.uniqid(), "password"=>"password", "fio"=>'Some FIO', "email"=>'test@test.ru', "rights"=>0];
        $create = $user->update();
        $this->assertTrue($create->done);
    }

    public function testDelete()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $delete = $user->delete(24);
        $this->assertTrue($delete->done);
    }

    public function testListTable()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $table = $user->listTable();
        $this->assertTrue($user->done);

    }

    public function testlistFields()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $table = $user->listFields();
        $this->assertTrue($user->done);

    }

    public function testNewFind()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $find = $user->find('login', 'admin');
        $this->assertEquals($find->fields['login'], 'admin');
    }

    public function testFilter()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $fields = ['login' => 'user', 'fio' => 'Ivanov N.N'];
        $filter1 = $user->makeSoftFilter($fields);
        $fields = ['rights' => 0];
        $filter2 = $user->makeSharpFilter($fields);
        $res = $user->composeWhere([$filter1, $filter2]);
        $this->assertEquals('WHERE 1=1  AND `login` LIKE \'%user%\'  AND `fio` LIKE \'%Ivanov N.N%\'  AND `rights` = \'0\' ', $res);

    }

    public function testOrder()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $fields = ['login', 'fio', 'rights'];
        $res = $user->composeOrder($fields);
        $this->assertEquals('ORDER BY `login` AND `fio` AND `rights`', $res);

    }

    public function testListFiltered()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $orders = ['login', 'fio', 'rights'];

        $fields = ['login' => 'user', 'fio' => 'Some'];
        $filter1 = $user->makeSoftFilter($fields);
        $fields = ['rights' => 0];
        $filter2 = $user->makeSharpFilter($fields);
        $filters = [$filter1, $filter2];
        $table = $user->listFiltered($orders, $filters);

        $this->assertEquals('password', $table[0]['password']);

    }

    public function testListFO()
    {
        $app = new crudExample\App();
        $app->init();
        $user = new UserOps($app);
        $orders = ['login', 'fio', 'rights'];

        $fields1 = ['login' => 'user', 'fio' => 'Some'];
        $fields2 = ['rights' => 0];
        $table = $user->listFO($orders, $fields1, $fields2);

        $this->assertEquals('password', $table[0]['password']);

    }

}
