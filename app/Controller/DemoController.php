<?php

namespace App\Controller;

use Core\Database\QueryBuilder;

class DemoController extends AppController
{
    public function index()
    {
        $query = new QueryBuilder();
        echo $query
            ->select('id', 'titre', 'contenu')
            ->where('Post.category_id = 1')
            ->where('Post.date > NOW()')
            ->from('articles', 'Post');
    }
}
