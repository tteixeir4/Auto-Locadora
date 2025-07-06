<?php
    include "logar.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos</title>
    <link rel="stylesheet" href="gerenciar.css">
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
    <button onclick="document.location='home.php'">Voltar</button>
    <button onclick="document.location='cadastrarveiculo.php'">Cadastrar Veículo</button>
    <fieldset>
    <h2>Buscar Veículo</h2>
    <div class="linha-busca">
        <input type="text" id="busca" placeholder="Buscar">
        <button id="pesquisar" type="button">Pesquisar</button>
    </div>
</fieldset>
    <div id="resultado"></div>
    <div>
        <iframe src="listarVeiculo.php" class="iframe"></iframe>
    </div>
    <script>
        const busca = document.getElementById('busca');
        const resultado = document.getElementById('resultado');

        busca.addEventListener('keyup', () => {
            const termo = busca.value;

            if (termo.length > 1) {
                fetch(`buscarveiculo.php?termo=${encodeURIComponent(termo)}`)
                    .then(res => res.text())
                    .then(data => {
                        resultado.innerHTML = data;
                        resultado.style.color = 'white'
                    });
            } else {
                resultado.innerHTML = '';
                resultado.style.color = 'white'
            }
        });
    </script>
    <script src="validacao.js"></script>
</body>
</html>