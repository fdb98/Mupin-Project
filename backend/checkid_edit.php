<?php
    declare(strict_types=1);
    require("vendor/autoload.php");
    use Classidb\Classlogin;
    $idcatalogo= $_POST["id_catalogo"];
    $idattuale =  $_POST["id_attuale"];
    //if
    $cn = new Classlogin;
      $pdo = $cn->usernopermit();
      $query = "SELECT * from id";
      $sth = $pdo->prepare($query);
      $sth->execute();
      $record = $sth->fetchAll();
      $n = count($record);
      $trovato = false;
      for($i=0; $i<$n && !$trovato; $i++){
        if(strcmp($record[$i]["id_catalogo"],$idcatalogo)===0){
            $trovato = true;
        }
      }
      if($trovato){
        echo 1;  //trovato
      }
      else{
        echo 0; //non trovato
      }
?>