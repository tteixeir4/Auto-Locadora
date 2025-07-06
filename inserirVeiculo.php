<?php

include "conecta.php";
require_once 'classVeiculo.php';

$placa = $_POST['veiculoPlaca'];
$marca = $_POST['veiculoMarca'];
$descricao = $_POST['veiculoDescricao'];


$veiculo = new Veiculo($placa, $marca, $descricao, $conexao);
$veiculo->inserirVeiculo();