<?php
/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 12:51
 */

use PHPUnit\Framework\TestCase;
require_once ("../../vendor/autoload.php");

class ConfigTest extends TestCase
{

    public function test()
    {
        $conf = new crudExample\App();
        $conn = $conf->initBase()->getConnection();
        $this->assertNotNull($conn, 'соединение не установлено');
    }

    public function testCreateTables()
    {
        $conf = new crudExample\App();
        $create = $conf->createEmptyTables();
        $this->assertTrue($create);
    }

}
