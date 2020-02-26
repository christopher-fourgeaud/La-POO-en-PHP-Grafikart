<?php


namespace Core\HTML;

/**
 * Class Form
 * Permet de générer un formulaire rapidement et simplement
 */
class Form
{
    /**
     * Données utilisées par le formulaire
     *
     * @var array|Object
     */
    private $data;

    /**
     * Tag utilisé pour entourer les champs
     *
     * @var string
     */
    public string $surround = 'p';

    /**
     * Données utilisées par le formulaire
     * 
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * Code html à entourer
     * 
     * @param string $html
     * @return string 
     */
    protected function surround(string $html): string
    {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * Index de la valeur à récupérer
     *
     * @param string $index
     * @return string
     */
    protected function getValue(string $index)
    {
        if (is_object($this->data)) {
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * Génère un Input
     * 
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function input(string $name, string $label, array $options = []): string
    {
        $type = isset($options['type']) ? $options['type'] : 'text';

        return $this->surround(
            '<input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '">'
        );
    }

    /**
     * Génère un submit button
     *
     * @return string
     */
    public function submit(): string
    {
        return $this->surround('<button type="submit">Envoyer</button>');
    }
}
