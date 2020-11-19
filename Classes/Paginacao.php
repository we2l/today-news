<?php

class Paginacao
{

    private function __construct() {}

    public static function paginacao()
    {
        $pagina = isset($_GET['pag']) ? $_GET['pag'] : 0;
        $inicio = ($pagina * 5);
        $paginacao = Database::paginacao($inicio);
        return $paginacao;
    }

    public static function totalPag() 
    {
        $total = Database::count();
        $total_pag = ceil($total['total'] / 5);
        $paginas = '';
        for($i = 0;  $i < $total_pag; $i++) {
            
            $paginas.= "<a href='index.php?pag={$i}'> [{$i}] </a>";
        }
        return $paginas;
    }

}