<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 11:14
 */

namespace crudExample;

abstract class Controller
{
    protected $app;
    /** @var string  */
    public $route;
    public $params = [];
    public $data = [];
    public $viewText;

    public $name;

    /**
     * Controller constructor.
     * @param string $route
     * @param App $app
     */
    public function __construct($app, $route = null)
    {
        $this->app = $app;
        $this->name = Helper::shortClassName($this);
        if ($route) {
            $this->route = $route;
        }

    }

    public function requestRoute()
    {
        return $this;
    }
    public function requestParams()
    {
        return $this;
    }
    public function requestData()
    {
        return $this;
    }
    public function requestView()
    {
        return $this;
    }

    public function requestAll()
    {
        return $this->requestRoute()->requestParams()->requestData()->requestView();
    }


}