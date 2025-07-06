<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="listar.css">
</head>
<body>
<?php

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}
require_once 'classLocacao.php';

$codigo = "";
$cliente = "";
$veiculo = "";
$inicio = "";
$fim = "";

$locacao = new Locacao($cliente, $veiculo, $inicio, $fim, $conexao);
$locacao ->listarLocacao();
?>