<?php

require 'vendor/autoload.php';

    session_start();
    $logged = $_SESSION["logged"] ?? -1;
    if($logged===true){
        echo "<h1>Già effettuato il login... reindirizzamento all'area riservata!</h1>";
        header("refresh:3; url=r-reserved_area.php");
        exit();
    }
    use League\Plates\Engine;
    $templateas = new Engine('src/frontend');
    echo $templateas->render('login'
    , [
    'title' => 'Login Area Riservata',
    'session' => false
    ]);
?>

