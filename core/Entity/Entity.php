<?php

namespace Core\Entity;

/**
 * Class Entity factory
 */
class Entity
{
    /**
     * Permet de récupérer la méthode get d'une classe en passant une key
     *
     * @param string $key
     * 
     * @return string
     */
    public function __get(string $key): string
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();

        return $this->$key;
    }
}
