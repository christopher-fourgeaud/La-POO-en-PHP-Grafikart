<?php

namespace App\Table;

use Core\Table\Table;

/**
 * Représente la table Post de la bdd
 */
class PostTable extends Table
{

    /**
     * Le nom de la table en bdd
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * Récupère les derniers articles
     *
     * @return array(PostEntity)
     */
    public function last()
    {
        return $this->query(
            "SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.titre as categorie
            FROM articles
            LEFT JOIN categories ON category_id = categories.id
            ORDER BY articles.date DESC"
        );
    }

    /**
     * Récupère un article en liant la catégorie associée
     * 
     * @param int $id
     * 
     * @return PostEntity
     */
    public function findWithCategory($id): object
    {
        return $this->query(
            "SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.titre as categorie
            FROM articles
            LEFT JOIN categories ON category_id = categories.id
            WHERE articles.id = ?",
            [$id],
            true
        );
    }

    /**
     * Récupère les derniers articles de la catégorie demandée
     * 
     *@param int $category_id
     * 
     * @return array
     */
    public function lastByCategory($category_id)
    {
        return $this->query(
            "SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.titre as categorie
            FROM articles
            LEFT JOIN categories ON category_id = categories.id
            WHERE articles.category_id = ?
            ORDER BY articles.date DESC",
            [$category_id]
        );
    }
}
