<?php

namespace App;

use App\Database;

class App
{
    private static $_instance;

    private $db_instance;

    public $title = "Mon super site";

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getTable($name)
    {
        $className = '\\App\\Table\\' . ucfirst($name) . 'Table';

        return new $className();
    }

    public function getDatabase()
    {
        $config = Config::getInstance();
        if (is_null($this->db_instance)) {
            $this->db_instance = new Database($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_password'));
        }
        return $this->db_instance;
    }
}
