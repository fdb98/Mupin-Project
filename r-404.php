<?php
require 'vendor/autoload.php';
    use League\Plates\Engine;
    session_Start();
    $templateas = new Engine('src/frontend');
    if(sizeof($_GET)==0){
        echo $templateas->render('404'
            , [
            'title' => 'Pagina Non trovata'
            ]);
        exit();
    }
    $table = $_GET["table"];
    $id_catalogo= $_GET["id_catalogo"];

    echo $templateas->render('db404'
    , [
    'title' => 'Visualizzazione Computer',
    'id_catalogo' => $id_catalogo,
    'table' => $table
    ]);
?>

