<?php
    declare(strict_types=1);
    require ('../vendor/autoload.php');
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Classidb\Classlogin;
    $log = new Logger('login');

    $email = $_POST["email"];
    $psw = $_POST["password"];
    $classlog = new Classlogin();
    session_start();
        try{
            $classlog->login($email,$psw);
        }
        catch(Exception $e){
            echo $e->getMessage();
            $log->error("Autenticazione Fallita");
            $_SESSION["logged"] =false;
            header("location:../r-login.php");
            exit();
        }
        $_SESSION["User-ID"] = $email;
        $_SESSION["logged"] = true;
        $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
        $log->info("User ".$email." logged in!");
        header("location: ../r-reserved_area.php");
        exit();
?>