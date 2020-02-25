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
}
