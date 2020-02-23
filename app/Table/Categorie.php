<?php

namespace App\Table;

use App\Table\Table;

class Categorie extends Table
{
    protected static $table = 'categories';

    /**
     * Get l'url de l'article
     *
     * @return string
     */
    public function getUrl(): string
    {
        return 'index.php?p=categorie&id=' . $this->id;
    }
}
