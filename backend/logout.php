<?php
    declare(strict_types=1);
    require("../vendor/autoload.php");
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    session_start();
    $log = new Logger("login");
    $log->pushHandler(new StreamHandler('../administrator.log'),Logger::INFO);
    $log->info("User ".$_SESSION["User-ID"]." logged out");
    session_unset();
    session_destroy();
   /* session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);*/
    
    header("location:../r-login.php");
?>