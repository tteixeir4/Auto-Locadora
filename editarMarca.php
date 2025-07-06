<?php
require_once 'classMarca.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}

$codigo = $_POST['codigoMarca'];
$nome = $_POST['nomeMarca'];

$marca = new Marca($codigo, $nome, $conexao);
$marca->editarMarca();