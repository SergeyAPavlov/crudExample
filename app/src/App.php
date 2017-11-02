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

    public function init()
    {

        $this->root = self::sliceDir(__DIR__, 2);
        $this->initBase();
        return $this;
    }

    public static function sliceDir ($dir, $level)
    {
        $pathArray = explode(DIRECTORY_SEPARATOR, $dir);
        $new = array_slice ( $pathArray, 0, -$level);
        return implode(DIRECTORY_SEPARATOR, $new);
    }

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
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
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
}