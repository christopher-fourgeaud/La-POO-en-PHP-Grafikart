<?php

namespace Core;


class Config
{

    /**
     * Correspond au tableau de settings à servir
     *
     * @var array
     */
    private array $settings = [];

    /**
     * Représente l'instance de la class Config
     *
     * @var Config
     */
    private static $_instance;

    public function __construct($file)
    {
        // Récupère le fichier ou charger les configs
        $this->settings = require($file);
    }

    /**
     * Renvoie l'instance de Config et la crée si elle n'existe pas
     *
     * @return Config
     */
    public static function getInstance($file = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }


    /**
     * Renvoie les valeurs associées à la clé
     *
     * @param string $key
     * 
     * @return string
     */
    public function get($key): string
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}
