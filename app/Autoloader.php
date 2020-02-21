<?php

namespace App;

/**
 * Class Autoloader
 */
class Autoloader
{

    /**
     * Enregistre notre autoloader
     *
     * @return void
     */
    static function register(): void
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * 
     * @param $class string Le nom de la classe à charger
     * @return void
     */
    static function autoload($class): void
    {
        require __DIR__ . '/' . $class . '.php';
    }
}
