<?php

namespace App\Entity;

use Core\Entity\Entity;


/**
 * Représente l'objet Entity
 */
class PostEntity extends Entity
{
    /**
     * Renvoi l'url de la page Post
     *
     * @return string
     */
    public function getUrl(): string
    {
        return 'index.php?p=posts.show&id=' . $this->id;
    }

    /**
     * Retourne un extrait d'article (les 100 premiers caractères)
     *
     * @return string
     */
    public function getExtrait(): string
    {
        $html = '<p>' . substr($this->contenu, 0, 100) . '...</P>';

        $html .= '<p><a href="' . $this->getUrl() . '">Voir la suite</a></p>';

        return $html;
    }
}
