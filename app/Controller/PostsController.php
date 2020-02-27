<?php

namespace App\Controller;


class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route posts.index
     *
     * @return void
     */
    public function index(): void
    {
        $posts = $this->Post->last();
        $categories = $this->Category->all();
        $this->render('posts.index', compact('posts', 'categories'));
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route posts.category
     *
     * @return void
     */
    public function category()
    {
        $categorie = $this->Category->find($_GET['id']);
        if ($categorie === false) {
            $this->notFound();
        }
        $articles = $this->Post->lastByCategory($_GET['id']);
        $categories = $this->Category->all();

        $this->render('posts.category', compact('articles', 'categories', 'categorie'));
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route posts.show
     *
     * @return void
     */
    public function show()
    {
        $article = $this->Post->findWithCategory($_GET['id']);
        $this->render('posts.show', compact('article'));
    }
}
