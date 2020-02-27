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

    public function index()
    {
        $categories = $this->Category->all();
        $this->render('admin.categories.index', compact('categories'));
    }

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

    public function delete()
    {
        if (!empty($_POST)) {
            $resultat = $this->Category->delete($_POST['id']);

            return $this->index();
        }
    }
}
