<?php
/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 13:53
 */

namespace crudExample;


class App extends Config
{

    /** @var  \mysqli */
    private $connection;
    public $root;

    public $login;
    public $logged;
    public $role;

    public $log;

    public function init()
    {

        $this->root = Helper::sliceDir(__DIR__, 2);
        $this->initBase();
        return $this;
    }


    /**
     * @return $this
     */
    public function initBase()
    {
        if (is_null($this->connection)){
            $this->connection = new \mysqli($this->dbaseHost, $this->dbaseUser, $this->dbasePassword, $this->dbaseName);
        }
        if ($this->connection->connect_errno){
            if (!$this->debug){
                echo "Извините, возникла проблема на сайте";
            }
            else {
                // На реальном сайте этого делать не следует
                echo "Ошибка: Не удалсь создать соединение с базой MySQL и вот почему: \n";
                echo "Номер_ошибки: " . $this->connection->connect_errno . "\n";
                echo "Ошибка: " . $this->connection->connect_error . "\n";
            }

        }
        return $this;

    }

    /**
     * @return \mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return string
     */
    public function getSole()
    {
        return $this->sole;
    }


    public function createEmptyTables()
    {
        $this->initBase();
        $db = $this->connection;
        $result = $db->query('SHOW TABLES');
        if (empty($result->fetch_assoc())){
            $sql = (new InitSite())->sqlTables;
            $create = $db->multi_query($sql);
            return $create;
        }
        return false;

    }

    public function logIt($log, $type = '', $errorlevel = 0)
    {
        $this->log[] = [$log, $type, $errorlevel, time()];
    }

}