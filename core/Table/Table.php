<?php

namespace Core\Table;

use Core\Database\MysqlDatabase;



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

            $this->table = strtolower(str_replace('Table', '', $className) . 's');
        }
    }

    public function all()
    {
        return $this->query(
            'SELECT *
            FROM ' . $this->table
        );
    }

    public function find($id)
    {
        return $this->query(
            "SELECT *
            FROM {$this->table}
            WHERE id = ?",
            [$id],
            true
        );
    }

    public function query($statement, $attributes = null, $one = false)
    {
        if ($attributes) {
            return $this->database->prepare(
                $statement,
                $attributes,
                str_replace(
                    'Table',
                    'Entity',
                    get_class($this),
                ),
                $one
            );
        } else {
            return $this->database->query(
                $statement,
                str_replace(
                    'Table',
                    'Entity',
                    get_class($this),
                ),
                $one
            );
        }
    }
}
