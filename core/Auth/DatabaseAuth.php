<?php

namespace Core\Auth;

use Core\Database\MysqlDatabase;

class DatabaseAuth
{
    private MysqlDatabase $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
    }

    /**
     * Retourne l'id de l'utilisateur connecté
     *
     * @return int|bool
     */
    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    /**
     * Log l'utilisateur si les informations fournies sont correctes
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password): bool
    {
        $user = $this->database->prepare(
            "SELECT *
            FROM users
            WHERE username = ?",
            [$username],
            null,
            true
        );
        if ($user) {
            if ($user->password === sha1(($password))) {
                $_SESSION['auth'] = $user->id;
                return true;
            }
        }
        return false;
    }

    /**
     * Verifie si l'utilisateur est connecté
     *
     * @return bool
     */
    public function logged(): bool
    {
        return isset($_SESSION['auth']);
    }
}
