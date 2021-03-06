<?php

namespace Event;

class Listener
{

    /**
     * @var callable
     */
    public $callback;

    /**
     * @var int
     */
    public int $priority;

    /**
     * Défini si le listener peut être appelé plusieurs fois
     *
     * @var boolean
     */
    private $once = false;

    /**
     * Permet de savoir combien de fois le listener à été appellé
     *
     * @var int
     */
    private $calls = 0;

    /**
     * Permet de stopper les évènements parents
     *
     * @var boolean
     */
    public $stopPropagation = false;


    public function __construct(callable $callback, int $priority)
    {
        $this->callback = $callback;
        $this->priority = $priority;
    }

    public function handle(array $args)
    {
        if ($this->once && $this->calls > 0) {
            return null;
        }
        $this->calls++;
        return call_user_func_array($this->callback, $args);
    }

    /**
     * Permet d'indiquer que le listener ne peut être appellé qu'une fois
     *
     * @return Listener
     */
    public function once(): Listener
    {
        $this->once = true;
        return $this;
    }

    /**
     * Permet de stopper l'execution des évènements suivant
     *
     * @return Listener
     */
    public function stopPropagation(): Listener
    {
        $this->stopPropagation = true;
        return $this;
    }
}
