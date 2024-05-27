<?php

define("DATABASE","database.sqlite3");

try {    
    $pdo = new PDO('sqlite:'.DATABASE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
//echo "conectado";//comentar esta linha após testar
?>