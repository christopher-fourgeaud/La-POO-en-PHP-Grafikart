<?php

use Core\Config;
use Core\Database\Database;
use Core\Database\MysqlDatabase;

/**
 * Classe App - singleton qui s'occupe de charger toutes les dépendances nécessaires
 */
class App
{
    /**
     * Représente l'instance de la classe App
     *
     * @var App
     */
    private static $_instance;

    /**
     * Représente l'instance de la connexion à la bdd
     *
     * @var Database
     */
    private $db_instance;

    /**
     * Représente le titre affiché par defaut dans les balises <title></title> du site
     *
     * @var string
     */
    public $title = "Mon super site";

    /**
     * Renvoie l'instance de App et la crée si elle n'existe pas
     *
     * @return App
     */
    public static function getInstance(): App
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * Permet de charger les Autoloaders des namespaces
     *
     * @return void
     */
    public static function load(): void
    {
        session_start();
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();

        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    /**
     * Récupère une table de la bdd
     *
     * @param string $name
     * @return object
     */
    public function getTable(string $name): object
    {
        // Crée le chemin vers le fichier correspondant au nom de la table
        $className = '\\App\\Table\\' . ucfirst($name) . 'Table';

        return new $className($this->getDatabase());
    }

    /**
     * Renvoie l'instance de la bdd et la crée si elle n'existe pas
     *
     * @return Database
     */
    public function getDatabase(): MysqlDatabase
    {
        // Récupère l'instance de la base de donnée en lui fournissant les configurations
        $config = Config::getInstance(ROOT . '/config/config.php');
        if (is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_password'));
        }
        return $this->db_instance;
    }
}
