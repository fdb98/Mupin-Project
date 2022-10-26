<?php
    declare(strict_types=1);
    require("../vendor/autoload.php");
    use Classidb\Classlogin;
    $cn = new Classlogin;
    $pdo = $cn->usernopermit();
    $id_catalogo = $_POST["id_catalogo"];
    $table = $_POST["fst_categoria"];
    $query = "SELECT * from $table WHERE id_catalogo = :id";
    $sth = $pdo->prepare($query);
    $sth->bindValue(':id', $id_catalogo, PDO::PARAM_STR);
    $sth->execute();
    if($sth->rowCount()==0){
        header("location:../r-404.php?id_catalogo=$id_catalogo&table=$table");
        exit();
    }
    header("location:../r-catalogo.php?id_catalogo=$id_catalogo&table=$table");
    