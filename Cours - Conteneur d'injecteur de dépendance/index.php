<?php

echo '<pre>';

require 'DIC.php';

class Foo
{
}

class Bar
{
    private $foo;
    private $name;


    public function __construct(Foo $foo, string $name = "Christopher")
    {
        $this->foo = $foo;
        $this->name = $name;
    }
}

$app = new DIC();

$app->set('Bar', function () {
    return new Bar(new Foo, 'Jordan');
});

var_dump($app->get('Bar'));


echo '</pre>';
