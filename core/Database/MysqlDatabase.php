<?php

namespace Core\Database;

use PDO;

/**
 * Classe MysqlDatabase
 */
class MysqlDatabase extends Database
{
    /**
     * L'addresse de l'hote de la bdd
     * 
     * @var string
     */
    private string $db_host;

    /**
     * Le nom de la bdd
     *
     * @var string
     */
    private string $db_name;

    /**
     * Le nom d'utilisateur de la bdd
     * 
     * @var string
     */
    private string $db_user;

    /**
     * Le mot de passe de la bdd
     * 
     * @var string
     */
    private string $db_password;

    /**
     * Contient la connexion à PDO
     *
     * @var PDO
     */
    private $pdo;

    /**
     * @param string $db_host
     * @param string $db_name
     * @param string $db_user
     * @param string $db_password
     * 
     * @return void
     */
    public function __construct(string $db_name, string $db_host = 'localhost', string $db_user = 'root', string $db_password = '')
    {
        $this->db_host     = $db_host;
        $this->db_name     = $db_name;
        $this->db_user     = $db_user;
        $this->db_password = $db_password;
    }

    /**
     * Récupère la connexion à PDO
     *
     * @return PDO
     */
    private function getPDO(): PDO
    {
        // Si la connexion n'existe pas on crée l'objet PDO
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . '', '' . $this->db_user . '', '' . $this->db_password . '');

            // Permet d'activer l'affichage du détail des erreurs 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * Construit une requète sql
     *
     * @param string $statement
     * @return array(Objects)
     */
    public function query(string $statement, string $class_name = null, $one = false): array
    {
        $request = $this->getPDO()->query($statement);
        if ($class_name === null) {
            $request->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $request->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $data = $request->fetch();
        } else {
            $data = $request->fetchAll();
        }
        return $data;
    }

    /**
     * @param string $statement
     * @param array $atributes
     * @param string $class_name
     * @return Object|array(Objects)
     */
    public function prepare(string $statement, array $atributes, string $class_name, bool $one = false)
    {
        $request = $this->getPDO()->prepare($statement);
        $request->execute($atributes);
        $request->setFetchMode(PDO::FETCH_CLASS, $class_name);

        if ($one) {
            $data = $request->fetch();
        } else {
            $data = $request->fetchAll();
        }
        return $data;
    }
}
