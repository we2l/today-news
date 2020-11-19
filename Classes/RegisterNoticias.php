<?php

require_once 'Model/DataBase.php';
require_once 'Classes/Noticias.php';
require_once 'Classes/Categorias.php';

class RegisterNoticias
{
    private $html;
    private $header;
    private $footer;
    private $htmlSearch;

    public function __construct()
    {   

        $this->header = file_get_contents('html/header.html');
        $this->footer = file_get_contents('html/footer.html');
        if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            $this->html = file_get_contents('html/intro.html'); 
        } else {
            $this->html = file_get_contents('html/register.html');
        }
    }

    public function show($param = null)
    {

        $html = $this->header;
        $html .= $param ? $param : $this->html; 
        $html .= $this->footer;
        print $html;
    }

    public function search()
    {
        $search = filter_input(INPUT_POST, 'search');
        $resultSearch = Database::research($search);
        $items = file_get_contents('html/item.html');

        $htmlItem = '';
        foreach($resultSearch as $item) {
            $titulo = $item['TITULO'];
            $conteudo = $item['CONTEUDO'];

            $replace = str_replace(['{titulo}', '{conteudo}'], [$titulo,$conteudo], $items);
            $htmlItem .= $replace;
        }
        $noticias = str_replace(['{item}', '{paginacao}'], [$htmlItem,''], $this->html);
        $this->show($noticias);

    }

    public function save()
    {
        $titulo = filter_input(INPUT_POST, 'titulo');
        $categoria = filter_input(INPUT_POST, "categoria");
        $conteudo = filter_input(INPUT_POST, 'conteudo');
        
        if($titulo && $categoria && $conteudo) {
            $noticias = new Noticias;
            $noticias->titulo = $titulo;
            $noticias->conteudo = $conteudo;

            $cat = new Categorias;
            $cat->categoria = $categoria;
            
            Database::save($noticias, $cat);
            header('location: index.php');
        }
    }


}