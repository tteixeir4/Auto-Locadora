<?php
require_once 'classCliente.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];

$cliente = new Cliente($cpf, $nome, $endereco, $conexao);
$cliente->editarCliente();
?>
