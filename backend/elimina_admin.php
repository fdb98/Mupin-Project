<?php
    declare(strict_types=1);
    require("../vendor/autoload.php");
    use Classidb\Classlogin;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;
    $log = new Logger("utente-elimina");
    $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
    $user= $_POST["user"];
    session_start();
      try{
        $cn = new Classlogin;
        $pdo = $cn->superadmin();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();
        $query = "DELETE FROM logindb WHERE user = :user";
        $sth = $pdo->prepare($query);
        $sth->bindParam("user",$user, PDO::PARAM_STR);
        $sth->execute();
        $pdo->commit();
        echo "1";
        //http_response_code(200);
        $log->info("User ".$_SESSION["User-ID"]." deleted admin: ".$user);

      }
    catch(PDOException $e){
      $pdo->rollBack();  
      echo "0";
      $log->error("User ".$_SESSION["User-ID"]." tried to delete user ".$user."  Errore: ".$e->getMessage());
    }
    catch(Exception $ex){
      $pdo->rollBack();
      $log->error("User ".$_SESSION["User-ID"]." tried to delete user ".$user."  Errore(ex): ".$ex->getMessage());
      echo "0";
    }
?>