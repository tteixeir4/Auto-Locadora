<?php
include 'classLocacao.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno) {
    echo "Falha na conexão com o banco de dados: " . $conexao->connect_error;
    exit();
}

$codigo = $_GET['codigo'];

if (!empty($codigo)) {
    $locacao = new Locacao("", "", "", "", $conexao);
    $locacao->excluirLocacao($codigo);
} else {
    echo "Erro: Código da locação não fornecido!";
}
?>
