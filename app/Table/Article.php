<?php

namespace App\Table;

class Article
{

    /**
     * Undocumented function
     *
     * @param string $key
     * @return string
     */
    public function __get(string $key): string
    {
        $method = 'get' . ucfirst($key);

        $this->$key = $this->$method;
        var_dump($this->$key);

        return $this->$key;
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
