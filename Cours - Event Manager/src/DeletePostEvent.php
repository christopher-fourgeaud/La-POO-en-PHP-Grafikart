<?php

namespace App;

use App\Post;
use App\Event;

class DeletePostEvent extends Event
{
    public function __construct(Post $post)
    {
        $this->setName('database.delete.post');
        $this->setTarget($post);
    }

    public function getTarget(): Post
    {
        return parent::getTarget();
    }
}
