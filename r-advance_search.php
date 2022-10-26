<?php

require 'vendor/autoload.php';
session_start();
use League\Plates\Engine;
$templateas = new Engine('src/frontend');
echo $templateas->render('search'
, [
'title' => 'Ricerca Avanzata',
]);
?>