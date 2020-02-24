<?php

namespace App\Table;

use App\Database\MysqlDatabase;


class Table
{
    protected $table;

    protected $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
        if (is_null($this->table)) {

            $parts = explode('\\', get_class($this));

            $className = end($parts);

            $this->table = strtolower(str_replace('Table', '', $className));
        }
    }

    public function all()
    {
        return $this->database->query(
            'SELECT *
            FROM articles'
        );
    }
}
