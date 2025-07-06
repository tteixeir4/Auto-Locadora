<?php
    include "logar.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="cadastros.css">
</head>
<body>
    <header>
        <img src="autoloc.png" width="200px" height="100px">
        <nav>
            <ul>
                <li><a href="#" onclick="confirmarLogout()">Sair</a></li>
            </ul>
        </nav>
    </header>
    <hr></hr>
    </div>
    <form name="Cliente" method="post" action="inserirFuncionario.php">
        <fieldset>
            <h2>Cadastro de Funcionário</h2>
            <div>
                <label>Nome Funcionário <input type="text" name="nomeFuncionario" required></label>
            </div>
                <label>Senha <input type="password" name="senhaFuncionario" required></label>
            <button type="submit">Cadastrar</button>
        </fieldset>
    </form>
    <div class="conteudo">
        <button onclick="document.location='home.php'">Voltar</button>
    </div>
    <script src="validacao.js"></script>
</body>
</html>