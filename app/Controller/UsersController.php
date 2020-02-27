<?php

namespace App\Controller;

use App;
use Core\Auth\DatabaseAuth;
use Core\HTML\BootstrapForm;

class UsersController extends AppController
{
    /**
     * Sert la vue et les donnees qui correspondent à la route users.login
     *
     * @return void
     */
    public function login()
    {
        $errors = false;
        if (!empty($_POST)) {
            $auth = new DatabaseAuth(App::getInstance()->getDatabase());

            if ($auth->login($_POST['username'], $_POST['password'])) {
                header('Location: index.php?p=admin.posts.index');
            } else {
                $errors = true;
            }
        }
        $form = new BootstrapForm($_POST);

        $this->render('users.login', compact('form', 'errors'));
    }
}
