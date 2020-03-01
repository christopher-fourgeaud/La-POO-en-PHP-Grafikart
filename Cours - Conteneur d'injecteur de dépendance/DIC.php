<?php

/**
 * Class DIC Dependency Injection Container
 */
class DIC
{

    /**
     * @var array
     */
    private $registry = [];

    /**
     * @var array
     */
    private $factories = [];

    /**
     * @var array
     */
    private $instances = [];


    /**
     * Sauvegarde l'instance de la classe passée en paramètre dans le tableau $registry
     *
     * @param string $key Le nom de la classe
     * @param callable $resolver La fonction qui permet de créer la classe
     * @return void
     */
    public function set(string $key, callable $resolver): void
    {
        $this->registry[$key] = $resolver;
    }

    /**
     * Sauvegarde l'instance de la classe passée en paramètre dans le tableau $factories
     *
     * @param string $key Le nom de la classe
     * @param callable $resolver La fonction qui permet de créer la classe
     * @return void
     */
    public function setFactory($key, callable $resolver): void
    {
        $this->factories[$key] = $resolver;
    }

    /**
     * Initie l'instance de la classe passée en paramètre dans le tableau $instances
     *
     * @param Object $instance Nom de la classe
     * @return void
     */
    public function setInstance(Object $instance): void
    {
        $reflection = new ReflectionClass($instance);

        // On enregistre à l'index correpondant au nom de la classe l'instance de celle ci
        $this->instances[$reflection->getName()] = $instance;
    }

    /**
     * Renvoie l'instance de la classe appelée en paramètre
     *
     * @param string $key Nom de la classe
     * @return void
     */
    public function get(string $key)
    {
        // Renvoie l'objet si celui existe à l'index $key dans le tableau des $factories
        if (isset($this->factories[$key])) {
            return $this->factories[$key]();
        }

        // Si la classe appelée n'existe pas, tente de la crée et de la servir
        if (!isset($this->instances[$key])) {
            if (isset($this->registry[$key])) {
                $this->instances[$key] = $this->registry[$key]();
            } else {
                $reflected_class = new ReflectionClass($key);
                if ($reflected_class->isInstantiable()) {
                    $constructor = $reflected_class->getConstructor();
                    if ($constructor) {
                        $parameters = $constructor->getParameters();
                        $constructor_parameters = [];
                        foreach ($parameters as $parameter) {
                            if ($parameter->getClass()) {
                                $constructor_parameters[] = $this->get($parameter->getClass()->getName());
                            } else {
                                $constructor_parameters[] = $parameter->getDefaultValue();
                            }
                        }
                        $this->instances[$key] = $reflected_class->newInstanceArgs($constructor_parameters);
                    } else {
                        $this->instances[$key] = $reflected_class->newInstance();
                    }
                } else {
                    throw new Exception($key . " is not an instanciable class.");
                }
            }
        }
        return $this->instances[$key];
    }
}
