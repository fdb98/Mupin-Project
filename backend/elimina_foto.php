<?php
  declare(strict_types=1);
  require("../vendor/autoload.php");
  use Classidb\Classlogin;
  use Monolog\Handler\StreamHandler;
  use Monolog\Logger;
  require("check_first_photo.php");
  $log = new Logger("utente");
  $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
  $idcatalogo= $_POST["id_catalogo"];
  $id=  $_POST["foto"];
  $n_foto= (int) $_POST["n_foto"];
  $categoria = $_POST["categoria"];
  session_start();
  if(file_exists("../".$id)){
    try{
      $cn = new Classlogin;
      $pdo = $cn->userwithpermit();
      $pdo->beginTransaction();
      $query = "UPDATE $categoria SET n_foto = :n_foto WHERE id_catalogo=:id_catalogo";
      $sth = $pdo->prepare($query);
      $n_foto--;
      $sth->bindParam("n_foto",$n_foto, PDO::PARAM_INT);
      $sth->bindParam("id_catalogo",$idcatalogo, PDO::PARAM_STR);
      $sth->execute();
      if(unlink("../".$id)){
        $log->info("User ".$_SESSION["User-ID"]." ha cancellato la foto ".$id);
        $pdo->commit();
        $ritorno=1;
        if($n_foto>0) {
          $rinominato = rename_first_foto($idcatalogo);
          if($rinominato===false){
            $log->error("Cannot rename a photo in 01 photo");
          }
          else{
            if($rinominato===true)$ritorno++;
          }
        }
        
        echo $ritorno;
        
      }
      else{
        $pdo->rollBack();
        $log->error("User ".$_SESSION["User-ID"]." non è riuscito a cancellare la foto ".$id."  Errore: Not Deleted");
        echo "0";
      }
    }
    catch(PDOException $pdoe){
      echo "-1";
      $pdo->rollBack();
      $log->error("User ".$_SESSION["User-ID"]." non è riuscito a cancellare la foto ".$id."  Errore: ".$pdoe->getMessage());
    }
    catch(Exception $ex){
        echo "-1";
        $pdo->rollBack();
        $log->error("User ".$_SESSION["User-ID"]." non è riuscito a cancellare la foto ".$id."  Errore: ".$ex->getMessage());
    }
  }
  else{
    echo "-2";
    $log->error("User ".$_SESSION["User-ID"]." non è riuscito a cancellare la foto ".$id."  Errore: File Not Found");
  }

    
?>