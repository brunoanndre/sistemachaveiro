<?php 
$host = 'localhost';
$dbname = 'Chaveiro';
$user = 'postgres';
$password = 'kaug6a38';
try{
$pdo = new PDO('pgsql:host=localhost;dbname=Chaveiro', $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "ERROR". $e->getMessage();
}
