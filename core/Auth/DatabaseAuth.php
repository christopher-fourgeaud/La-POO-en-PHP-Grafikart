<?php

namespace Core\Auth;

use Core\Database\MysqlDatabase;

class DatabaseAuth
{
    private $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
    }

    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    /**
     * Undocumented function
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

    public function logged()
    {
        return isset($_SESSION['auth']);
    }
}
