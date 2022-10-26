<?php
declare(strict_types=1);
namespace Classidb;
//require 'vendor/autoload.php';
use PDO;
use PDOException;
class Connectdb{
function connect(string $dsn, string $user, string $password){
    try {
    $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
    printf("Connection failed: %s \n", $e->getMessage());
    exit(1);
    }
    return $pdo;
    }
}