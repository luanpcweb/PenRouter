<?php

namespace Pen;

/**
 *
 */
class Container
{

    protected static $instance;

    protected $bindings = [];

    protected function __construct()
    {

    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function register($alias, $implementation)
    {
        $this->bindings[$alias] = $implementation;

        return $this;
    }

    public function unRegister($aliasOrClassName)
    {
        if (array_key_exists($aliasOrClassName, $this->bindings)) {
            unset($this->bindings[$aliasOrClassName]);
        }

        return $this;
    }

    public function make($alias)
    {
        if (array_key_exists($alias, $this->bindings)) {
            $classOrObject = $this->bindings[$alias];

            if (is_object($classOrObject)) {
                return $classOrObject;
            }

            return $this->makeInstance($classOrObject);
        }

        if (class_exists($alias)) {
            return self::register($alias, $this->makeInstance($alias))->make($alias);
        }

        return null;
    }

    protected function makeInstance($className)
    {
        $reflection = new \ReflectionClass($className);

        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return $reflection->newInstance();
        }

        return $reflection->newInstanceArgs($this->resolveParameters($constructor->getParameters(), []));
    }

    public function resolveMethodParameters($instance, $method, $parameters, $labels = false)
    {
        $reflectionMethod = new \ReflectionMethod($instance, $method);

        return $this->resolveParameters($reflectionMethod->getParameters(), $parameters, $labels);
    }

    public function resolveFunctionParameters($callable, $parameters, $labels)
    {
        $reflectionFunction = new \ReflectionFunction($callable);

        return $this->resolveParameters($reflectionFunction->getParameters(), $parameters, $labels);
    }

    private function resolveParameters($parameters, $data, $labels = false)
    {
        $parametersToPass = [];

        foreach ($parameters as $reflectionParameter) {

            $parametersClassName = isset($reflectionParameter->getClass()->name) ? $reflectionParameter->getClass()->name : '';

            if ($parametersClassName) {
                $parametersToPass[] = self::make($parametersClassName);

            } else if ($labels && isset($data[$reflectionParameter->getName()])) {

                $parametersToPass[] = $data[$reflectionParameter->getName()];
                unset($data[$reflectionParameter->getName()]);

            } else if (!$labels && count($data)) {

                $parametersToPass[] = $data[0];

                array_shift($data);

                reset($data);
            } else {
                $parametersToPass[] = null;
            }
        }

        return $parametersToPass;
    }
}
