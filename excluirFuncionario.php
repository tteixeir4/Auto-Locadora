<?php
include 'classFuncionario.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno) {
    echo "Falha na conexão com o banco de dados: " . $conexao->connect_error;
    exit();
}

$matricula = $_GET['matricula'] ?? '';

if (!empty($matricula)) {
    $funcionario = new Funcionario("", $matricula, "", $conexao);
    $funcionario->excluirFuncionario();
} else {
    echo "Erro: Número de matrícula não fornecida!";
}
?>