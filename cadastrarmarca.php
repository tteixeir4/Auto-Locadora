<?php
    include "logar.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Possui cadastro?</title>
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
    <form name="Cliente" method="post" action="inserirMarca.php">
        <fieldset>
            <h2>Cadastro de Marca</h2>
            <div>
                <label>Nome da Marca <input type="text" name="nomeMarca" required></label>
            </div>
            <button type="submit">Cadastrar</button>
        </fieldset>
    </form>
    <div class="conteudo">
        <button onclick="document.location='home.php'">Voltar</button>
    </div>
    <script src="validacao.js"></script>
</body>
</html>