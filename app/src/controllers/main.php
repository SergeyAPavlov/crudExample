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

    public function requestParams()
    {
        Authorize::check($this->app);
        return $this;
    }
    public function requestData()
    {
        echo '*main.requestData:'.$this->route;
        if ($this->route == 'register'){
            echo '*регистрация';
            exit;
        }
        if (!$this->app->logged){
            $controller = new auth($this->app, 'auth');
            echo '*controller.auth';
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
        View::display($this->app, 'main', $this->data);
    }
}