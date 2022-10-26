<?php

require 'vendor/autoload.php';
    use League\Plates\Engine;
    $templateas = new Engine('src/frontend');
    
    
    if(sizeof($_GET)==0){
        header("location:r-404.php");
        exit();
    }
    $table = $_GET["table"];
    $id_catalogo= $_GET["id_catalogo"];


    echo $templateas->render('visualizza'
    , [
    'title' => 'Visualizzazione Computer',
    'id_catalogo' => $id_catalogo,
    'table' => $table
    ]);
    
   
?>

