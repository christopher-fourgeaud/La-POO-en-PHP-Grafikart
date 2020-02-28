<?php

namespace App\Controller;

use Query;

class DemoController extends AppController
{
    public function index()
    {
        require ROOT . '/Query.php';
        echo Query::select('id', 'titre', 'contenu')
            ->where('Post.category_id = 1')
            ->where('Post.date > NOW()')
            ->from('articles', 'Post');
    }
}
