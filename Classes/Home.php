<?php

require_once './Model/DataBase.php';

class Home 
{   
    private $html;
    private $noticias;
    private $data;

    public function __construct()
    {   
        $this->html = file_get_contents('html/intro.html');
        $this->noticias = Paginacao::paginacao();
    }

    public function show()
    {   
        $newHtml = '';
        $item = file_get_contents('html/item.html');
        $paginas = Paginacao::totalPag();
        
        
        foreach($this->noticias as $noticia) {
            
            $html = str_replace(['{titulo}', '{conteudo}'], [$noticia->TITULO, $noticia->CONTEUDO], $item);
            $newHtml .= $html;
        }

        
        $html = file_get_contents('html/header.html'); 
        $html .= str_replace(['{item}', '{paginacao}'], [$newHtml,$paginas], $this->html);  
        $html .= file_get_contents('html/footer.html');
        
        print $html;

    }

    public function getNoticias()
    {   
        return $this->noticias;
    }
}