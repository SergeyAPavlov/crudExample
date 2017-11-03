<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 02.11.2017
 * Time: 20:44
 */

namespace crudExample;


class Router
{
    public $rout;
    private $app;

    public $routList = ['userlist', 'usercreate','userread', 'userupdate', 'userdelete', 'register'];

    public function __construct($app)
    {
        $this->app = $app;
        $this->setRout()->setRigts();
    }

    /**
     * @return $this
     */
    public function setRigts()
    {
        $this->app->rights = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function setRout()
    {
        if (empty($_SERVER['REDIRECT_URL'])) {
            $this->rout = 'main';
            return $this;
        }

        $dir = substr($_SERVER['REDIRECT_URL'], 1);
        if ( in_array($dir, $this->routList)){
            $this->rout = $dir;
        }
        else $this->rout = 'none';
        return $this;
    }

    /**
     * @return string
     */
    public function getRout()
    {
        return $this->rout;
    }






}