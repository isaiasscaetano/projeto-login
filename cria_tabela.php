<?php
require_once "conecta.php";

/*---- Cria tabela ----*/
$query = "CREATE TABLE IF NOT EXISTS USER(
id_user INTEGER not null primary key autoincrement, 
login TEXT, 
senha TEXT, 
data date)";
$pdo->exec($query);
echo "Tabela criada com sucesso!";
$pdo = null;//encerra a conexão com banco de dados
?>