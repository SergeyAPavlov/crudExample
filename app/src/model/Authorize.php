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
                $login = $_COOKIE['login']['value'];
                $role = $_COOKIE['role']['value'];
                $expires = $_COOKIE['login']['expires'];
                $auth = $_COOKIE['auth']['value'];
                $hash = md5($login.$role.$expires.$app->getSole());
                if ( $auth == $hash){
                    $app->logged = true;
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
            return true;
        }
        return false;

    }

    public static function setAuth(App $app, $login, $role)
    {
        $time = time();
        $expires = $time+60*60*24*30;
        setcookie("login", $login,  $expires);
        setcookie("role", $role,  $expires);

        $auth = md5($login.$role.$expires.$app->getSole());
        setcookie("auth", $auth, $expires);

    }


}