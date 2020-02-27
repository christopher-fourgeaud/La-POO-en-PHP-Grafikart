<?php

namespace App\Controller\Admin;

use App;
use Core\Auth\DatabaseAuth;


class AppController extends \App\Controller\AppController
{
    public function __construct()
    {
        parent::__construct();

        // Authentification
        $app = App::getInstance();
        $auth = new DatabaseAuth($app->getDatabase());

        if (!$auth->logged()) {
            $this->forbidden();
        }
    }
}
