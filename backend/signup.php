<?php
require 'vendor/autoload.php';
//use Libsodium;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Classidb\Connectdb;
    $log = new Logger("utente");
    $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
    $email = $_POST["email"];
    $psw = password_hash($_POST["password"],PASSWORD_BCRYPT);
    //sodium_memzero($_POST["password"]);
    sodium_memzero($_POST["password"]);
    unset($_POST["password"]);
    
    $cn = new Connectdb();
    $dsn = "mysql:dbname=credenziali;host=127.0.0.1" ;
    $user = 'root';
    $password = '';
    $pdo = $cn->connect($dsn,$user,$password); //$cn->connect($db,$psw);
    $sql = "SELECT user, password FROM logindb WHERE user = :user";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':user', $email,PDO::PARAM_STR);
    $sth->execute();
    if($sth->rowCount()==1){
        echo "0";
        exit();
    }
    try{
        $pdo->beginTransaction();  
        $sql = "INSERT INTO logindb (user,password) VALUES(:user,:password)";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':user', $email,PDO::PARAM_STR);
        $sth->bindValue(':password', $psw,PDO::PARAM_STR);
        $sth->execute();
        $pdo->commit();
        $log->info("$email added");
        echo "1";
    }
    catch(PDOException $ex){
        $log->error($ex);
        echo -1;
    }
    
    