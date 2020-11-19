<?php

class Database
{

    private static $conn;

    public static function getConnection()
    {
        if(empty(self::$conn)) {
            self::$conn = new PDO("mysql:dbname=noticias; host=localhost", 'root', 'computadorpc123');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function find($id)
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM NOTICIAS
                WHERE IDNOTICIA = :id";
        $select = $conn->prepare($sql);
        $select->bindValue(":id", $id);
        $select->execute();
        $result = $select->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public static function all($filter = '') 
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM NOTICIAS";
        if($filter) {
            $sql .= " WHERE {$filter}";
        }
        $select = $conn->prepare($sql);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public static function delete($idNoticia, $idCategoria) 
    {

        $conn = self::$conn;
        
        $sqlNoticiasCategorias = "DELETE FROM NOTICIAS_CATEGORIAS 
        WHERE ID_NOTICIA = :idNoticia AND ID_CATEGORIA = :idCategoria";
        $deleteNoticiasCategorias = $conn->prepare($sqlNoticiasCategorias);
        $deleteNoticiasCategorias->bindValue("idNoticia", $idNoticia);
        $deleteNoticiasCategorias->bindValue("idCategoria", $idCategoria);
        $deleteNoticiasCategorias->execute();
        
        $sqlNoticia = "DELETE FROM NOTICIAS WHERE IDNOTICIA = :idNoticia";
        $deleteNoticia = $conn->prepare($sqlNoticia);
        $deleteNoticia->bindValue(":idNoticia", $idNoticia);
        $deleteNoticia->execute();

        $sqlCategoria = "DELETE FROM CATEGORIAS WHERE IDCATEGORIA = :idCategoria";
        $deleteCategoria = $conn->prepare($sqlCategoria);
        $deleteCategoria->bindValue(":idCategoria", $idCategoria);
        $deleteCategoria->execute();

    }

    public static function research($titulo) {
        $conn = self::getConnection();
        $sql = "SELECT * FROM noticias WHERE titulo LIKE '%$titulo%' LIMIT 5";
        $search = $conn->prepare($sql);
        $search->execute();
        $result = $search->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function count($filter = null) 
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as total FROM NOTICIAS";
        if($filter) {
            $sql .= " WHERE {$filter}";
        }
        $count = $conn->prepare($sql);
        $count->execute();
        $result = $count->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function paginacao($inicio)
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM NOTICIAS LIMIT {$inicio}, 5 ";
        $paginacao = $conn->prepare($sql);
        $paginacao->execute();
        return $paginacao->fetchAll(PDO::FETCH_OBJ);
    }

    public static function save($noticia, $categoria)
    {   
        $conn = self::getConnection();
        if(empty($noticia->id)) {
            $sqlNoticia = "INSERT INTO NOTICIAS (IDNOTICIA, TITULO, CONTEUDO)
            VALUES (:idnoticia, :titulo, :conteudo)";
            $insert = $conn->prepare($sqlNoticia);
            $insert->bindValue("idnoticia", NULL);
            $insert->bindValue(":titulo", $noticia->titulo);
            $insert->bindValue(":conteudo", $noticia->conteudo);
            $insert->execute();

            $sqlCategoria = "INSERT INTO CATEGORIAS (IDCATEGORIA, CATEGORIA)
            VALUES (:idcategoria, :categoria)";
            $insertCategoria = $conn->prepare($sqlCategoria);
            $insertCategoria->bindValue(":idcategoria", NULL);
            $insertCategoria->bindValue(":categoria", $categoria->categoria);
            $insertCategoria->execute();

            $idNoticia = self::getLastIdNoticias();
            $idCategoria = self::getLastIdCategorias();
            $sqlNoticias_Categorias = "INSERT INTO NOTICIAS_CATEGORIAS (ID_NOTICIA, ID_CATEGORIA)
            VALUES (:id_noticia, :id_categoria)";
            $insertNoticias_Categorias = $conn->prepare($sqlNoticias_Categorias);
            $insertNoticias_Categorias->bindValue("id_noticia", $idNoticia);
            $insertNoticias_Categorias->bindValue("id_categoria", $idCategoria);
            $insertNoticias_Categorias->execute();
        }
    }


    private static function getLastIdNoticias() {
        $conn = self::getConnection();
        $sql = "SELECT MAX(IDNOTICIA) FROM NOTICIAS";
        $select = $conn->prepare($sql);
        $select->execute();
        $result = $select->fetch();
        return $result[0];
    }

    private static function getLastIdCategorias() {
        $conn = self::getConnection();
        $sql = "SELECT MAX(IDCATEGORIA) FROM CATEGORIAS";
        $select = $conn->prepare($sql);
        $select->execute();
        $result = $select->fetch();
        return $result[0];
    }

}