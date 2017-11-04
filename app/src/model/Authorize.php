<?php
/**
 * Created by PhpStorm.
 * User: Sergey Pavlov
 * Date: 03.11.2017
 * Time: 11:52
 */

namespace crudExample\model;


use crudExample\App;

class Authorize
{
    public static function check(App $app)
    {
        $app->logged = false;
        if (!empty($_COOKIE)){
            try{
                //var_dump($_COOKIE);
                $login = $_COOKIE['login'];
                $role = $_COOKIE['role'];
                $expires = $_COOKIE['expires'];
                $auth = $_COOKIE['auth'];
                $hash = md5($login.$role.$expires.$app->getSole());
                if ( $auth == $hash){
                    $app->logged = true;
                    $app->login = $login;
                    $app->role = $role;
                    return true;
                }
            } catch (\Throwable $t){
                return false;
            }
        }
        return false;
    }

    public static function checkLogin(App $app, $login, $password)
    {
        $base = new UserOps($app);
        $base->find('login', $login);
        if (empty($base->fields)){
            return false;
        }
        if ($base->fields['password'] == $password){
            $app->role = $base->fields['rights'];
            return true;
        }
        return false;

    }

    public static function setAuth(App $app, $login)
    {
        $time = time();
        $expires = $time+60*60*24*30;
        setcookie("login", $login,  $expires);
        setcookie("role", $app->role,  $expires);
        setcookie("expires", $expires,  $expires);
        $auth = md5($login.$app->role.$expires.$app->getSole());
        setcookie("auth", $auth, $expires);

    }

    public static function removeAuth()
    {
        $time = time();
        $expires = $time-3600;
        setcookie("login", '',  $expires);
        setcookie("role", '',  $expires);
        setcookie("expires", '',  $expires);
        setcookie("auth", '', $expires);

    }


}