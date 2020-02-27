<?php

namespace App\Controller\Admin;

use App;
use Core\HTML\BootstrapForm;


class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route admin.posts.index
     *
     * @return void
     */
    public function index()
    {
        $posts = $this->Post->all();
        $this->render('admin.posts.index', compact('posts'));
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route admin.posts.add
     *
     * @return void
     */
    public function add()
    {
        if (!empty($_POST)) {
            $resultat = $this->Post->create([
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'category_id' => $_POST['category_id']
            ]);
            if ($resultat) {
                return $this->index();
            }
        }
        $this->loadModel('Category');
        $categories = $this->Category->extract('id', 'titre');
        $form = new BootstrapForm($_POST);

        $this->render('admin.posts.edit', compact('form', 'categories'));
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route admin.posts.edit
     *
     * @return void
     */
    public function edit()
    {
        if (!empty($_POST)) {
            $resultat = $this->Post->update($_GET['id'], [
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'category_id' => $_POST['category_id']

            ]);

            if ($resultat) {
                return $this->index();
            }
        }
        $post = $this->Post->find($_GET['id']);
        $this->loadModel('Category');
        $categories = $this->Category->extract('id', 'titre');
        $form = new BootstrapForm($post);

        $this->render('admin.posts.edit', compact('form', 'categories'));
    }

    /**
     * Sert l'action de suppression d'un article
     *
     * @return void
     */
    public function delete()
    {
        if (!empty($_POST)) {
            $resultat = $this->Post->delete($_POST['id']);

            return $this->index();
        }
    }
}
