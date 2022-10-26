<?php

require 'vendor/autoload.php';

session_start();

if(!isset($_SESSION["logged"]) || !$_SESSION["logged"]){
    echo '<script type ="text/JavaScript">';  
    echo "alert(\"Accesso Negato! Devi fare il login per accedere a questa pagina!\");";
    echo "window.location.replace('r-login.php');";
    echo '</script>';  
    exit(); 
}
echo "<head><link rel=\"stylesheet\" href=\"styles/style-reserved.css\"/></head>";
use League\Plates\Engine;
$templateas = new Engine('src/frontend');
echo $templateas->render('reservedarea'
    , [
    'title' => 'Area Riservata!',
    'name' => $_SESSION["User-ID"]
    ]);
?>

