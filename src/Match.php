<?php

namespace Pen;

class Match
{

    private $callable;

    private $parameters;

    private $options;

    public function __construct($callable, $parameters, $options = [])
    {
        $this->callable = $callable;
        $this->parameters = $parameters;
        $this->options = $options;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function setCallable($callable)
    {
        $this->callable = $callable;
        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}
