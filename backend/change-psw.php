<?php
    declare(strict_types=1);
    require("../vendor/autoload.php");
    use Classidb\Classlogin;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;
    $user = $_POST["user"];
    $psw = $_POST["psw"];
    //sodium_memzero($_POST["password"]);
    sodium_memzero($_POST["psw"]);
    unset($_POST["psw"]);
    session_start();

    $log = new Logger("utente");
    $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);

    $cn = new Classlogin;
      $pdo = $cn->superadmin();
      try{
        $query = "SELECT  password FROM logindb WHERE user = :user";
        $sth = $pdo->prepare($query);
        $sth->bindParam('user',$user,PDO::PARAM_STR);
        $sth->execute();
        $record = $sth->fetchAll();
        if(count($record)==0){
            echo -2;
            $log->error("Param Error in Query");
            exit();
        }
        if(password_verify($psw,$record[0][0])){
            echo 0;
            exit();
        }
        $psw = password_hash($psw,PASSWORD_BCRYPT);
        $query = "UPDATE logindb SET password = :psw WHERE user = :user";
        $sth = $pdo->prepare($query);
        $sth->bindParam('user',$user,PDO::PARAM_STR);
        $sth->bindParam('psw',$psw,PDO::PARAM_STR);
        $sth->execute();
        $record = $sth->fetchAll();
        $n = count($record);
      
      if($n>0){
        $log->info("User ".$_SESSION["User-ID"]." changed password for ".$user);
        echo 1;  //psw cambiata
      }
      else{
        $log->error("Cannot change password for '".$user."' , ".$_SESSION["User-ID"]);
        echo -1; //psw non cambiata
      }
    }
    catch(Exception $e){
        $log->error("Exception e ->".$e->getMessage());
        echo -3; //psw non cambiata
    }
    session_destroy();
?>