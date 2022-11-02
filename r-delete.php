<?php

require 'vendor/autoload.php';
session_start();
    if(!isset($_SESSION["logged"]) || !$_SESSION["logged"]){
        echo '<script type ="text/JavaScript">';  
        echo "alert(\"Accesso Negato! Devi fare il login per accedere a questa pagina!\");";
        echo "window.location.replace('r-login.php');";
        echo '</script>';  
        exit(); 
    }
    if(sizeof($_GET)==0){
        header("location:r-404.php");
        exit();
    }
    $id_catalogo = $_GET["id_catalogo"];
    $table = $_GET["table"];

    use League\Plates\Engine;
    $templateas = new Engine('src/frontend');
    echo $templateas->render('elimina'
    , [
    'title' => 'Visualizzazione Computer',
    'id_catalogo' => $id_catalogo,
    'table' => $table
    ]);
?>
<!--<script src="scripts\reserved-style.js"></script>-->

