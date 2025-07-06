<?php
include 'classVeiculo.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno) {
    echo "Falha na conexão com o banco de dados: " . $conexao->connect_error;
    exit();
}

$placa = $_GET['placa'];

if (!empty($placa)) {
    $veiculo = new Veiculo("", "", "", $conexao);
    $veiculo->excluirVeiculo($placa);
} else {
    echo "Erro: Placa do veículo não fornecida!";
}
?>