<?php

namespace Core\Database;

class QueryBuilder
{
    private $fields = [];
    private $conditions = [];
    private $from = [];

    public function select()
    {
        $this->fields = func_get_args();

        return $this;
    }

    public function where()
    {
        foreach (func_get_args() as $argument) {
            $this->conditions[] = $argument;
        }
        return $this;
    }

    public function from($table, $alias = null)
    {
        if ($alias === null) {
            $this->from[] = $table;
        } else {
            $this->from[] = "$table AS $alias";
        }

        return $this;
    }

    public function __toString()
    {
        return 'SELECT ' . implode(', ', $this->fields)
            . ' FROM ' . implode(', ', $this->from)
            . ' WHERE ' . implode(' AND ', $this->conditions);
    }
}
