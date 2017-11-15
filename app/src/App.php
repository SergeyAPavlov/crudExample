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
    private $safe;
    public $root;

    public $login;
    public $logged;
    public $role;

    public $log;

    public function init()
    {

        $this->root = Helper::sliceDir(__DIR__, 2);
        $this->initBase();
        $this->initSafe();
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
     * @return $this
     * @throws \Exception
     */
    public function initSafe()
    {
        if (is_null($this->safe)) {
            $opt = array(
                'host' => $this->dbaseHost,
                'user' => $this->dbaseUser,
                'pass' => $this->dbasePassword,
                'db' => $this->dbaseName
            );
            $this->safe = new \SafeMySQL($opt);
            if (empty($this->safe)) {
                Throw new \Exception('подключение к базе не удалось');
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
     * @return mixed
     */
    public function getSafe()
    {
        return $this->safe;
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