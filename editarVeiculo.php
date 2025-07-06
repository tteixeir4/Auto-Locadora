<?php
require_once 'classVeiculo.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

$placa = $_POST['veiculoPlaca'];
$marca = $_POST['veiculoMarca'];
$descricao = $_POST['veiculoDescricao'];

$veiculo = new Veiculo($placa, $marca, $descricao, $conexao);
$veiculo->editarVeiculo();
?>
