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
    use League\Plates\Engine;
    $templateas = new Engine('src/frontend');

    if(sizeof($_GET)==0){
        $categoria = '';
    }
    else{
        $categoria = $_GET["table"];
    }    
    
    echo $templateas->render('insert'
    , [
    'title' => 'Inserisci',
    'categoria' => $categoria
    ]);
?>
<!--<script src="scripts\reserved-style.js"></script>-->
