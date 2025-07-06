<?php
include 'classMarca.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno) {
    echo "Falha na conexão com o banco de dados: " . $conexao->connect_error;
    exit();
}

$codigo = $_GET['codigo'];

if (!empty($codigo)) {
    $marca = new Marca($codigo, "", $conexao);
    $marca->excluirMarca();
} else {
    echo "Erro: Código da marca não fornecido!";
}
?>