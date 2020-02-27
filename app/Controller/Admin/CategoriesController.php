<?php

namespace App\Controller\Admin;

use App;
use Core\HTML\BootstrapForm;


class CategoriesController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Category');
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route admin.categories.index
     *
     * @return void
     */
    public function index(): void
    {
        $categories = $this->Category->all();
        $this->render('admin.categories.index', compact('categories'));
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route admin.categories.add
     *
     * @return void
     */
    public function add()
    {
        if (!empty($_POST)) {
            $resultat = $this->Category->create([
                'titre' => $_POST['titre'],
            ]);
            return $this->index();
        }
        $form = new BootstrapForm($_POST);

        $this->render('admin.categories.edit', compact('form'));
    }

    /**
     * Sert la vue et les donnees qui correspondent à la route admin.categories.edit
     *
     * @return void
     */
    public function edit()
    {
        if (!empty($_POST)) {
            $resultat = $this->Category->update($_GET['id'], [
                'titre' => $_POST['titre'],
            ]);
            return $this->index();
        }
        $category = $this->Category->find($_GET['id']);
        $form = new BootstrapForm($category);

        $this->render('admin.categories.edit', compact('form'));
    }

    /**
     * Sert l'action de suppression d'une catégorie
     *
     * @return void
     */
    public function delete()
    {
        if (!empty($_POST)) {
            $resultat = $this->Category->delete($_POST['id']);

            return $this->index();
        }
    }
}
