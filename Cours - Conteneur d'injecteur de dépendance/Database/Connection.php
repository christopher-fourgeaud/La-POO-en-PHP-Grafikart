<?php

namespace Database;

class Connection
{
    /**
     *
     * @var string
     */
    private string $db_name;

    /**
     *
     * @var string
     */
    private string $db_username;

    /**
     *
     * @var string
     */
    private string $db_password;

    private string $uniqid;

    public function __construct($db_name, $db_username, $db_password)
    {
        $this->db_name = $db_name;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
        $this->uniqid = uniqid();
    }
}
