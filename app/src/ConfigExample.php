<?php

/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 12:49
 */

namespace crudExample;

class Config
{
    // настройки
    protected $dbaseName = 'crud';
    protected $dbaseUser = 'crud';
    protected $dbasePassword = '***';
    protected $dbaseHost = 'localhost';

    protected $sole = '***';

    public $templateDir = 'app/templates';

    public $usersTable = 'users';

    public $debug = 1;

}