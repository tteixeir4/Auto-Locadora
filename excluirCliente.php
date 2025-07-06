<?php
include 'classCliente.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno) {
    echo "Falha na conexão com o banco de dados: " . $conexao->connect_error;
    exit();
}

$cpf = $_GET['cpf'];

if (!empty($cpf)) {
    $cliente = new Cliente("", "", "", $conexao);
    $cliente->excluirCliente($cpf);
} else {
    echo "Erro: CPF não fornecido!";
}
?>