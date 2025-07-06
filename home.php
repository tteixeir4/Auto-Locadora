<?php
    session_start();

    $tempo = $_SERVER['REQUEST_TIME'];
    $duracao_inatividade = 3600;

    if (isset($_SESSION['ultima_atividade']) &&
        ($tempo - $_SESSION['ultima_atividade']) > $duracao_inatividade) {
        
        session_unset();
        session_destroy();

        header("Location: login.html");
    exit();
    }

    $_SESSION['ultima_atividade'] = $tempo;

    if(!isset($_SESSION['matricula'])){
        header("Location: login.html");
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Locadora</title>
<link rel="stylesheet" href="home.css">
</head>
<body>
    <header>
        <img src="autoloc.png" width="200px" height="100px">
        <nav>
            <ul>
                <li><span class="usuario-nome">Olá, <?php echo $_SESSION['nome']; ?></span></li>
                <li><a href="#" onclick="confirmarLogout()">Sair</a></li>
            </ul>
        </nav>
    </header>
    <hr></hr>
    <div class="content">
    <div><button onclick="document.location='gerenciarcliente.php'">
        <img src="cliente.png" class="button-icon">
        <br>
        <br><span class="button-text">Gerenciar
            <br>Cliente
        </span>
    </button>
    </div>
    <div><button onclick="document.location='gerenciarveiculo.php'">
        <img src="carro.png" class="button-icon">
        <br>
        <br><span class="button-text">Gerenciar
            <br>Veículos
        </span>
    </button>
    </div>
    <div><button onclick="document.location='gerenciarlocacao.php'">
        <img src="chave.png" class="button-icon">
        <br>
        <br><span class="button-text">Gerenciar
            <br>Locações
        </span>
    </button>
    </div>
    <div><button onclick="document.location='gerenciarmarca.php'">
        <img src="volkswagen.png" class="button-icon">
        <br>
        <br><span class="button-text">Gerenciar
            <br>Marca
        </span>
    </button>
    </div>
    <div><button onclick="document.location='gerenciarfuncionario.php'">
        <img src="funcionario.png" class="button-icon">
        <br>
        <br><span class="button-text">Gerenciar
            <br>Funcionario
        </span>
    </button>
    </div>
    <script src="validacao.js"></script>
</body>
</html>