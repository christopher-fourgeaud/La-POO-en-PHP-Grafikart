<?php

namespace App\Controller;

use App;
use Core\Controller\Controller;

class AppController extends Controller
{
    /**
     * Represente le nom d'un template
     *
     * @var string
     */
    protected string $template = 'default';


    public function __construct()
    {
        // Mise en place du chemin vers le dossier des vues
        $this->viewPath = ROOT . '/app/Views/';
    }

    /**
     * Permet de charger l'instance de App et la Table correspondant au paramètre $model_name
     *
     * @param string $model_name
     * 
     * @return void
     */
    protected function loadModel(string $model_name): void
    {
        $this->$model_name =  App::getInstance()->getTable($model_name);
    }
}
