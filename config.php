<?php
//Pagina de configuração para conectar com o servidor
session_start();
$base = 'http://localhost/devsbookoo';

//nome e dados do banco de dados
$db_name = 'devsbook';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$maxWidth = 800;
$maxHeight = 800;

$pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass);
