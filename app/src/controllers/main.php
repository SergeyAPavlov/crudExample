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
        //echo '*main.start:'.$this->route." - \n";
        if ($this->route == 'register'){
            $controller = new register($this->app, 'register');
            $controller->requestAll();
            exit;
        }
        if ($this->route == 'logout'){
            $controller = new logout($this->app, 'logout');
            $controller->requestAll();
            exit;
        }
        if (!$this->app->logged){
            $this->data['logged'] = false;
            $controller = new auth($this->app, 'auth');
            $this->data['content'] = $controller->requestAll();
        }
        else {
            $this->data['logged'] = true;
            $rout = ($this->route == 'main'? 'list':$this->route);
            $role = ($this->app->role?'admin':'user');
            $controllerName = __NAMESPACE__.'\\'.$role.$rout;
            if (!class_exists($controllerName)) {
                $controller = new none($this->app, 'none');
            } else {
                $controller = new $controllerName($this->app, $role . $rout);
            }

            //echo '*sub:'.$role.$rout;
            $this->data['content'] = $controller->requestAll();
            $this->data['login'] = $this->app->login;
        }
        return $this;
    }
    public function requestView()
    {
        View::display($this->app, 'main', $this->data);
    }
}