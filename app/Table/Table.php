<?php

namespace App\Table;

class Table
{
    protected $table;

    public function __construct()
    {
        if (is_null($this->table)) {

            $parts = explode('\\', get_class($this));

            $className = end($parts);

            $this->table = strtolower(str_replace('Table', '', $className));
        }
    }
}
