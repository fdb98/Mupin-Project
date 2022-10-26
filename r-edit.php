<?php

require 'vendor/autoload.php';
    echo "<script src='https://code.jquery.com/jquery-1.10.2.js'></script>";
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
    $categoria = $_GET["table"];
    $id_catalogo=$_GET["id_catalogo"];

    use League\Plates\Engine;
    $templateas = new Engine('src/frontend');
    echo $templateas->render('edit'
    , [
    'title' => 'Modifica Computer',
    'table' => $categoria,
    'id_catalogo' => $id_catalogo,
    ]);
?>
