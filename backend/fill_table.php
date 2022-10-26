<?php
    declare(strict_types=1);
    $table = $_POST["table"];
    require("../vendor/autoload.php");
    $Classe = "Classi\\".ucfirst($table);
    $var = new $Classe;
    $json = json_encode($var::CATEGORIE);
    echo $json;
?>