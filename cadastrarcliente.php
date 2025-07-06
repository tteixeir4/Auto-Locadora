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
    <form id="cadcliente" name="Cliente" method="post" action="inserirCliente.php">
        <fieldset>
            <h2>Cadastro de Cliente</h2>
            <div>
                <label>Nome <input type="text" name="clienteNome" placeholder="Nome" required></label>
                <label>CPF <input type="text" id="cpf" name="clienteCpf" placeholder="CPF sem pontos e traços" required maxlength="11"></label>
            </div>
                <label>Endereço <input type="text" id="endereco" name="clienteEndereco" placeholder="Endereço" required></label>
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