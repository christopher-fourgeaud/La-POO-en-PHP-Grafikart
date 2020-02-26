<?php

namespace Core\Table;

use Core\Database\MysqlDatabase;


/**
 * Class Table factory
 */
class Table
{
    /**
     * Un nom de table en bdd
     *
     * @var string
     */
    protected $table;

    /**
     * Représente l'instance de la bdd
     *
     * @var Database
     */
    protected $database;

    /**
     * Construit l'objet Table en y injectant la bdd Mysql
     *
     * @param MysqlDatabase $database
     * 
     * @return void
     */
    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;

        // Si le nom de la table n'est pas renseigné, génère le nom en se basant sur le nom de la classe
        if (is_null($this->table)) {

            $parts = explode('\\', get_class($this));

            $className = end($parts);

            $this->table = strtolower(str_replace('Table', '', $className) . 's');
        }
    }

    /**
     * Requète à la bdd qui récupère tout les enregistrements d'une table
     *
     * @return array(Objects)|Object
     */
    public function all()
    {
        return $this->query(
            'SELECT *
            FROM ' . $this->table
        );
    }

    /**
     * Requète à la bdd qui récupère un seul enregistrement en passant l'id en paramètre
     *
     * @param int $id
     * 
     * @return object
     */
    public function find(int $id): object
    {
        return $this->query(
            "SELECT *
            FROM {$this->table}
            WHERE id = ?",
            [$id],
            true
        );
    }

    /**
     * Retourne une requète préparé si il y a des attributs passé à celle ci sinon retourne une requète classique
     *
     * @param string $statement
     * @param array $attributes
     * @param boolean $one
     * 
     * @return array(object)|object
     */
    public function query(string $statement, array $attributes = null, bool $one = false)
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

    /**
     * Fonction permetant de créer un enregistrement dans la bdd
     * 
     * @param array $fields
     * 
     * @return bool
     */
    public function create(array $fields)
    {
        $sql_parts = [];

        $attributes = [];

        foreach ($fields as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }

        $sql_part = implode(',', $sql_parts);

        return $this->query(
            "INSERT INTO {$this->table}
            SET $sql_part",
            $attributes,
            true
        );
    }

    /**
     *
     * Fonction permetant de mettre à jour un enregistrement dans la bdd
     * 
     * @param int $id
     * @param array $fields
     * 
     * @return bool
     */
    public function update(int $id, array $fields)
    {
        $sql_parts = [];

        $attributes = [];

        foreach ($fields as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $attributes[] = $id;

        $sql_part = implode(',', $sql_parts);

        return $this->query(
            "UPDATE {$this->table}
            SET $sql_part
            WHERE id = ?",
            $attributes,
            true
        );
    }

    /**
     *
     * Fonction permetant la suppression d'un enregistrement dans la bdd
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->query(
            "DELETE FROM {$this->table}
            WHERE id = ?",
            [$id],
            true
        );
    }

    /**
     * Transforme un tableau d'objet en tableau de chaine de caractère ou l'on associe la value à la key
     *
     * @param string $key
     * @param string $value
     * 
     * @return array
     */
    function extract(string $key, string $value): array
    {
        $records = $this->all();
        $return = [];

        foreach ($records as $v) {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }
}
