<?php

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}
?>