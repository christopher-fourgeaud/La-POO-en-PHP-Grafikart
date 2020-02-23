<?php

namespace App;

class App
{
    /**
     * Contient l'objet Database
     *
     * @var Database
     */
    private static $database;

    private static $title = 'Mon super site';

    /**
     * @var string
     */
    const DB_NAME = 'bdd-test';

    /**
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * @var string
     */
    const DB_USER = 'root';

    /**
     * @var string
     */
    const DB_PASS = '';

    public static function getDatabase()
    {
        if (self::$database === null) {
            self::$database = new Database(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
        }

        return self::$database;
    }

    public static function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        header('Location:index.php?p=404');
    }

    public static function getTitle()
    {
        return self::$title;
    }

    public static function setTitle($title)
    {
        self::$title = $title . ' | ' . self::$title;
    }
}
