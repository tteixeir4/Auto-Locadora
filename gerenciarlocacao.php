<?php
    include "logar.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locações</title>
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
    <button onclick="document.location='cadastrarlocacao.php'">Nova Locação</button>
        <fieldset>
    <h2>Buscar Locação</h2>
    <div class="linha-busca">
        <input type="text" id="busca" placeholder="Buscar">
    </div>
</fieldset>
    <div id="resultado"></div>
    <div>
        <iframe src="listarLocacao.php" class="iframe"></iframe>
    </div>
    <script>
        const busca = document.getElementById('busca');
        const resultado = document.getElementById('resultado');

        busca.addEventListener('keyup', () => {
            const termo = busca.value;

            if (termo.length > 1) {
                fetch(`buscarlocacao.php?termo=${encodeURIComponent(termo)}`)
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
</body>
</html>