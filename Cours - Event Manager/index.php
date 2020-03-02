<?php
require 'vendor/autoload.php';

use App\EventManager;
use App\DeletePostEvent;
use App\Post;

$manager = new EventManager;

// On va écouter des évènements
$manager->attach('database.delete.post', function (DeletePostEvent $event) {
    unlink($event->getTarget()->getImage());
});

// Dans notre code
$post = new Post;
$manager->trigger(new DeletePostEvent($post));
