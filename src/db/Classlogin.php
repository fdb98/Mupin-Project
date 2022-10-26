<?php
declare(strict_types=1);
namespace Classidb;
use Exception;
use PDO;
class Classlogin{
    public function login(string $email, string $psw){
        $cn = new connectdb();
        $dsn = "mysql:dbname=credenziali;host=127.0.0.1" ;
        $user = 'user';
        $password = '';
        $pdo = $cn->connect($dsn,$user,$password);
        $sql = "SELECT user, password FROM logindb WHERE user = :user";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':user', $email, PDO::PARAM_STR);
        $sth->execute();
        if($sth->rowCount()==0){
            throw new Exception("Utente non registrato");
        }
        $result = $sth->fetchAll();
        if(!password_verify($psw,$result[0]["password"])){
            throw new Exception("UnAuthorized");
        }
    }

    public function usernopermit(){
            $cn = new connectdb();
            $dsn = "mysql:dbname=mupin;host=127.0.0.1" ;
            $user = 'user';
            $password = '';
            $pdo = $cn->connect($dsn,$user,$password);
            return $pdo;
    }

    public function userwithpermit(){
        $cn = new connectdb();
        $dsn = "mysql:dbname=mupin;host=127.0.0.1" ;
        $user = 'admin';
        $password = 'uqTvGHT!tCgrNVcb';
        $pdo = $cn->connect($dsn,$user,$password);
        return $pdo;
}
}