<?php

namespace App\Table;

use App\App;
use App\Table\Table;

class Article extends Table
{

    protected static $table = 'articles';

    public static function getAllArticles()
    {
        return self::query(
            "SELECT articles.id, articles.titre, articles.contenu, categories.titre as categorie
            FROM articles
            LEFT JOIN categories
                ON category_id = categories.id
            ORDER BY articles.date DESC"
        );
    }

    /**
     * Retourne un élément d'une table
     *
     * @param int $id
     * @return void
     */
    public static function find($id)
    {
        return self::query(
            "SELECT articles.id, articles.titre, articles.contenu, categories.titre as categorie
            FROM articles
            LEFT JOIN categories
                ON category_id = categories.id
            WHERE articles.id = ?
            ORDER BY articles.date DESC",
            [$id],
            true
        );
    }

    public static function lastByCategory($category_id)
    {
        return self::query(
            "SELECT articles.id, articles.titre, articles.contenu, categories.titre as categorie
            FROM articles
            LEFT JOIN categories
                ON category_id = categories.id
            WHERE category_id = ?",
            [$category_id]
        );
    }

    /**
     * Get l'url de l'article
     *
     * @return string
     */
    public function getUrl(): string
    {
        return 'index.php?p=article&id=' . $this->id;
    }

    /**
     * Get l'extrait de l'article
     *
     * @return string
     */
    public function getExtrait(): string
    {
        $html = '<p>' . substr($this->contenu, 0, 200) . '...</p>';
        $html .= '<p><a href="' . $this->getUrl() . '">Voir la suite</p>';

        return $html;
    }
}
