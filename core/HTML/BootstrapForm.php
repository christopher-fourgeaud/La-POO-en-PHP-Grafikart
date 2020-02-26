<?php

namespace Core\HTML;

/**
 * Class BootstrapForm
 * Permet de générer un formulaire bootsrapé rapidement et simplement
 */
class BootstrapForm extends Form
{

    /**
     * Code html à entourer
     * 
     * @param string $html
     * @return string 
     */
    protected function surround(string $html): string
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * Génère un Input
     * 
     * @param string $name
     * @param string $label
     * @param array $options
     * 
     * @return string
     */
    public function input(string $name, string $label, array $options = []): string
    {
        $type = isset($options['type']) ? $options['type'] : 'text';

        $label = '<label>' . $label . '</label>';

        if ($type === 'textarea') {
            $input = '<textarea name="' . $name . '" class="form-control">' . $this->getValue($name) . '</textarea>';
        } else {
            $input = '<input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '" class="form-control">';
        }

        return $this->surround($label . $input);
    }

    /**
     * Génère un submit button
     *
     * @return string
     */
    public function submit(): string
    {
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }

    public function selectInput($name, $label, $options)
    {
        $label = '<label>' . $label . '</label>';
        $input = '<select class="form-control" name="' . $name . '">';
        foreach ($options as $key => $value) {
            $attributes = '';
            if ($key == $this->getValue($name)) {
                $attributes = 'selected';
            }
            $input .= "<option value='$key' $attributes>$value</option>";
        }
        $input .= '</select>';

        return $this->surround($label . $input);
    }
}
