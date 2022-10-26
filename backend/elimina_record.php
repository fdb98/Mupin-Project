<?php
    declare(strict_types=1);
    require("../vendor/autoload.php");
    use Classidb\Classlogin;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;
    $log = new Logger("utente-elimina");
    $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
    $idcatalogo= $_POST["id_catalogo"];
    $n_foto= $_POST["n_foto"];
    session_start();
      try{
        $cn = new Classlogin;
        $pdo = $cn->userwithpermit();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();
        $query = "DELETE FROM id WHERE id_catalogo = :id_catalogo";
        $sth = $pdo->prepare($query);
        $sth->bindParam("id_catalogo",$idcatalogo, PDO::PARAM_STR);
        $sth->execute();
        $pdo->commit();
        //ELIMINAZIONE FOTO DAL SERVER
        
        $path    = '../upload/img/';
        $files = scandir($path);
        $nnum = count($files);
        $trov=0;
        $img = array();
        for($i=2; $i<$nnum && $trov<$n_foto; $i++){
            if(strpos($files[$i],$idcatalogo)!==false){
                $img[$trov]=$files[$i];
                $trov++;
            }
        }
        unset($files);
        for($i=0; $i<$trov; $i++){
            if(!unlink($path.$img[$i])){
              $log->error($path.$img[$i]." cannot be deleted (deleting record)");
            }
        }
        echo "1";
        $log->info("User ".$_SESSION["User-ID"]." deleted record and photos with id: ".$idcatalogo);

      }
    catch(PDOException $e){
      $pdo->rollBack();  
      echo "0";
      $log->error("User ".$_SESSION["User-ID"]." tried to delete record ".$idcatalogo."  Errore: ".$e->getMessage());
    }
    catch(Exception $ex){
      $pdo->rollBack();
      $log->error("User ".$_SESSION["User-ID"]." tried to delete record ".$idcatalogo."  Errore(ex): ".$ex->getMessage());
      echo "0";
    }
?>