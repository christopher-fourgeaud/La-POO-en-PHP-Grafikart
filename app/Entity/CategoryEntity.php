<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 * Représente l'objet Category
 */
class CategoryEntity extends Entity
{
    /**
     * Renvoi l'url de la page Category
     *
     * @return string
     */
    public function getUrl(): string
    {
        return 'index.php?p=posts.category&id=' . $this->id;
    }
}
