<?php

namespace Core\Controller;

class Controller
{
    protected $viewPath;
    protected $template;

    protected function render($view, $variables = [])
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
