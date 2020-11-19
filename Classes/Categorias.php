<?php

class Categorias
{
    private $dados;

    public function __set($prop, $value)
    {
        $this->dados[$prop] = $value;
    }

    public function __get($name)
    {
        return $this->dados[$name];
    }
}