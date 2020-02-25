<?php

use Core\Config;
use Core\Database\MysqlDatabase;

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

    public static function load()
    {
        session_start();
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();

        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    public function getTable($name)
    {
        $className = '\\App\\Table\\' . ucfirst($name) . 'Table';

        return new $className($this->getDatabase());
    }

    public function getDatabase()
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        if (is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_password'));
        }
        return $this->db_instance;
    }
}
