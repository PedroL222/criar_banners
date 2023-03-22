<?php

$servidor = "localhost";
$banco = "criar_banners";
$userbanco ="root";
$senha = "root";


try {
    $dbh = new PDO("mysql:host=$servidor;dbname=$banco",$userbanco,$senha);
    
} catch (Exception $ex) {
    printf("Erro de Conexão:", $ex->getMessage());
}

?>