<?php

include 'classLocacao.php';
$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Erro na conexão: " . $conexao->connect_error;
    exit();
}

$codigo = $_POST['codigo'];
$cliente = $_POST['cliente'];
$veiculo = $_POST['veiculo'];
$dataInicio = $_POST['dataInicio'];
$dataFim = $_POST['dataFim'];

$locacao = new Locacao($cliente, $veiculo, $dataInicio, $dataFim, $conexao);
$locacao->editarLocacao($codigo);
?>
