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
    private $safe;
    public $root;

    public $login;
    public $logged;
    public $role;

    public $log;

    public function init()
    {
        $this->root = Helper::sliceDir(__DIR__, 2);
        $this->initSafe();
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


    public function logIt($log, $type = '', $errorlevel = 0)
    {
        $this->log[] = [$log, $type, $errorlevel, time()];
    }

}