<?php

echo '<pre>';

require 'DIC.php';

/**
 * Dummy class Foo
 */
class Foo
{
}

/**
 * Dummy class Bar
 */
class Bar
{
    /**
     * Dummy property foo
     *
     * @var Foo
     */
    private Foo $foo;

    /**
     * Dummy property name
     *
     * @var string
     */
    private string $name;


    public function __construct(Foo $foo, string $name = "Christopher")
    {
        $this->foo = $foo;
        $this->name = $name;
    }
}

// DIC = Dependency Injection Container
$app = new DIC();

$foo = new Foo;

var_dump($app->get('Bar'));



echo '</pre>';
