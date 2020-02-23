<?php

namespace App\Table;

use App\App;

class Table
{

    protected static $table;


    /**
     * Retourne tout les élements d'une table
     *
     * @return void
     */
    public static function getAll()
    {
        return App::getDatabase()->query(
            "SELECT *
            FROM " . static::$table . "",
            get_called_class()
        );
    }

    public static function query($statement, $attributes = null, $one = false)
    {
        if ($attributes) {
            return App::getDatabase()->prepare(
                $statement,
                $attributes,
                get_called_class(),
                $one
            );
        } else {
            return App::getDatabase()->query(
                $statement,
                get_called_class(),
                $one
            );
        }
    }

    /**
     * Retourne un élément d'une table
     *
     * @param [type] $id
     * @return void
     */
    public static function find($id)
    {
        return static::query(
            "SELECT *
            FROM " . static::$table . "
            WHERE id = ?",
            [$id],
            true
        );
    }

    /**
     * @param string $key
     * @return string
     */
    public function __get(string $key): string
    {
        $method = 'get' . ucfirst($key);

        $this->$key = $this->$method;
        var_dump($this->$key);

        return $this->$key;
    }
}
