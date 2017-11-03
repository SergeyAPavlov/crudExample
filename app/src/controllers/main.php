<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 11:34
 */

namespace crudExample\controllers;

use crudExample\Controller;
use crudExample\model\Authorize;
use crudExample\Router;
use crudExample\View;

class main extends Controller
{
    public function requestRoute()
    {
        if (empty($this->route)){
            $this->route = (new Router($this->app))->rout;
        }

        return $this;

    }
    public function requestParams()
    {
        Authorize::check($this->app);
        return $this;
    }
    public function requestData()
    {
        if (!$this->app->logged){
            $controller = new auth($this->app, 'auth');
            $this->data['content'] = $controller->requestAll();
        }
        else {
            $controllerName = $this->app->role.$this->route;
            $controller = new $controllerName($this->app, $controllerName);
            $this->data['content'] = $controller->requestAll();
        }
        return $this;
    }
    public function requestView()
    {
        View::display($this->app, $this->route, $this->data);
    }
}