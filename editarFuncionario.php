<?php
require_once 'classFuncionario.php';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}

$matricula = $_POST['funcionario_matricula'];
$nome = $_POST['funcionario_nome'];
$senha = $_POST['funcionario_senha'];

$funcionario = new Funcionario($nome, $matricula, $senha, $conexao);
$funcionario->editarFuncionario();