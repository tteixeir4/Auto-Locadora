<?php

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}
require_once 'classFuncionario.php';

$nome = $_POST['nomeFuncionario'];
$senha = $_POST['senhaFuncionario'];


$funcionario = new Funcionario($nome, "", $senha, $conexao);
$funcionario->inserirFuncionario();