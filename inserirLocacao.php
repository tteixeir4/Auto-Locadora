<?php
$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}
require_once 'classCliente.php';
require_once 'classLocacao.php';

$cliente = $_POST['clienteNome'];
$veiculo = $_POST['veiculoNome'];
$inicio = $_POST['dataInicio'];
$fim = $_POST['dataFim'];

$locacao = new Locacao($cliente, $veiculo, $inicio, $fim, $conexao);
$locacao->inserirLocacao();