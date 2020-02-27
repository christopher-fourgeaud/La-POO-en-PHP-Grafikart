<?php

namespace Core\Controller;

/**
 * Main Controller
 */
class Controller
{
    /**
     * Représente le chemin vers le dossier des vues
     *
     * @var string
     */
    protected string $viewPath;

    /**
     * Represente le nom d'un template
     *
     * @var string
     */
    protected string $template;

    /**
     * Permet de rendre une vue en lui passant des paramètres
     *
     * @param string $view Le nom de la vue
     * @param array $variables Les données à passer à la vue
     * 
     * @return void
     */
    protected function render(string $view, array $variables = []): void
    {
        ob_start();
        extract($variables);
        require($view = $this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }

    /**
     * Redirection quand accès non autorisé
     *
     * @return void
     */
    protected function forbidden(): void
    {
        header('HTTP/1.0 403 Forbidden');
        die('Accès interdit');
    }

    /**
     * Redirection quand page introuvable
     *
     * @return void
     */
    protected function notFound(): void
    {
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }
}
