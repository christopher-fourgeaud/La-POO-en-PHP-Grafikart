<?php

use Event\Emitter;

require 'vendor/autoload.php';

$emitter = Emitter::getInstance();

$emitter->on('Comment.created', function ($firstname, $lastname) {
    echo $firstname . ' ' . $lastname . ' a posté un nouveau commentaire.';
}, 1);

$emitter->on('Comment.created', function ($firstname, $lastname) {
    echo $firstname . ' ' . $lastname . ' a posté un nouveau commentaire.';
}, 100);


$emitter->emit('Comment.created', "Christopher", "Fourgeaud");
$emitter->emit('User.new');

// $emitter->on('User.new', function($user){
//         mail(...);
//     });

//     $emitter->on('User.new', function($user){
//         mail(...);
//     });
