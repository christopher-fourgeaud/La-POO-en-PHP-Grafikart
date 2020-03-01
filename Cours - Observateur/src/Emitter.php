<?php

namespace Event;

class Emitter
{
    private static $_instance;

    /**
     * Enregistre la liste des écouteurs
     *
     * @var Listener[][]
     */
    private $listeners = [];

    /**
     * Récupère l'instance de Emitter et la crée si elle n'éxiste pas (singleton)
     *
     * @return Emitter
     */
    public static function getInstance(): Emitter
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Envoie un évènement
     *
     * @param string $event Nom de l'evenement
     * @param array ...$args Le reste des arguments
     */
    public function emit(string $event, ...$args)
    {
        if ($this->hasListener($event)) {
            foreach ($this->listeners[$event] as $listener) {
                $listener->handle($args);
                if ($listener->stopPropagation) {
                    break;
                }
            }
        }
    }

    /**
     * Permet d'écouter un évènement
     *
     * @param string $event Nom de l'evenement
     * @param callable $callable La fonction à appeler
     * @param int $priority Ordre de priorité
     * 
     * @return Listener
     * 
     */
    public function on(string $event, callable $callable, int $priority = 0): Listener
    {
        if (!$this->hasListener($event)) {
            $this->listeners[$event] = [];
        }
        $this->checkDoubleCallableForEvent($event, $callable);
        $listener = new Listener($callable, $priority);
        $this->listeners[$event][] = $listener;
        $this->sortListeners($event);

        return $listener;
    }

    /**
     * Permet d'écouter un évènement et de lancer le listener une seule fois
     *
     * @param string $event
     * @param callable $callable
     * @param integer $priority
     * @return Listener
     */
    public function once(string $event, callable $callable, int $priority = 0): Listener
    {
        return $this->on($event, $callable, $priority)->once();
    }

    /**
     * Permet d'ajouter un subscriber qui ba écouter plusieurs évènement
     *
     * @param SubscriberInterface $subscriber
     * @return void
     */
    public function addSubscriber(SubscriberInterface $subscriber)
    {
        $events = $subscriber->getEvents();
        foreach ($events as $event => $method) {
            $this->on($event, [$subscriber, $method]);
        }
    }

    private function hasListener(string $event): bool
    {
        return array_key_exists($event, $this->listeners);
    }

    private function sortListeners($event)
    {
        uasort($this->listeners[$event], function ($a, $b) {
            return $a->priority < $b->priority;
        });
    }

    private function checkDoubleCallableForEvent(string $event, callable $callable): bool
    {
        foreach ($this->listeners[$event] as $listener) {
            if ($listener->callback === $callable) {
                throw new DoubleEventException();
            }
        }
        return false;
    }
}
