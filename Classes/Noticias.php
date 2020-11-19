<?php

class Noticias
{
    private $dados;
    private $categoria;

    public function __get($prop)
    {
        return $this->dados[$prop];
    }

    public function __set($prop, $value)
    {
        $this->dados[$prop] = $value; 
    }

}