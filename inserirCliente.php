<?php

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}
require_once 'classCliente.php';

$cpf = $_POST['clienteCpf'];
$nome = $_POST['clienteNome'];
$endereco = $_POST['clienteEndereco'];


$cliente = new Cliente($cpf, $nome, $endereco, $conexao);
$cliente->inserirCliente();