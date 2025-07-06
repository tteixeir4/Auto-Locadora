<?php

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}
require_once 'classMarca.php';

$nome = $_POST['nomeMarca'];


$marca = new Marca("", $nome, $conexao);
$marca->inserirMarca();