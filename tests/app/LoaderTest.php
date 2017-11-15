<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 02.11.2017
 * Time: 13:41
 */

use crudExample\View;
use PHPUnit\Framework\TestCase;
require_once ("../../vendor/autoload.php");
class ViewTest extends TestCase
{

    public function testIt()
    {
        $app = new crudExample\App();
        $app->init();
        View::display($app, 'test', ['t1'=>'поле']);
        $text = View::prepare($app, 'test', ['t1'=>'поле']);
        $this->assertEquals('Пробный текст поле


', $text);
    }

    public function testSafeSql()
    {
        $safe = new SafeMySQL();
        $this->assertTrue(is_object($safe));
    }

    public function testSafeSqlInit()
    {
        $opt = array(
            'host' => 'localhost',
            'user' => 'crudTest',
            'pass' => 'crudTest',
            'db' => 'crudTest'
        );
        $safe = new SafeMySQL($opt);
        $this->assertTrue(is_object($safe));
    }

}
