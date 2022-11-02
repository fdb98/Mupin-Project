<?php
declare(strict_types=1);
require 'vendor/autoload.php';
session_start();
use League\Plates\Engine;
$templateas = new Engine('src/frontend');
echo $templateas->render('home'
, [
'title' => 'MUPIN Home!',
]);


?>
