<?php

require 'vendor/autoload.php';

    session_start();
    $logged = $_SESSION["logged"] ?? -1;
    $admin = $_SESSION["User-ID"] ?? false;
    if($logged!==true || $admin !=="admin@mupin.it"){
        echo "<h1>403 - Non possiedi le autorizzazioni per questa pagina!</h1>";
        header("refresh:3; url=r-reserved_area.php");
        exit();
    }
    use League\Plates\Engine;
    $templateas = new Engine('src/frontend');
    echo $templateas->render('manage_admin'
    , [
    'title' => 'Gestore Admin'
    ]);
?>

