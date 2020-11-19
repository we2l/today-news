<?php

require_once 'Model/DataBase.php';
require_once 'Classes/Home.php';
require_once 'Classes/RegisterNoticias.php';
require_once 'Classes/Paginacao.php';

$class = isset($_REQUEST['class']) ? $_REQUEST['class'] : null;
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : null;

if(class_exists( $class)) {
    $pagina = new $class($_REQUEST);
    if(!empty($method) && method_exists($class, $method)) {
        $pagina->$method( );
    }

} else {
    $home = new Home();
    $home->show();

}
?>

