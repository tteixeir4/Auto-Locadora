<?php
    session_start();

    $tempo = $_SERVER['REQUEST_TIME'];
    $duracao_inatividade = 3600;

    if (isset($_SESSION['ultima_atividade']) &&
        ($tempo - $_SESSION['ultima_atividade']) > $duracao_inatividade) {
        
        session_unset();
        session_destroy();

        header("Location: login.html"); //Redireciona para login após destruir sessão
    exit();
    }

    $_SESSION['ultima_atividade'] = $tempo;

    if(!isset($_SESSION['matricula'])){
        header("Location: login.html");
    }
?>