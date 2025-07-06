<?php

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if ($conexao->connect_errno){
    echo "Falhou ao conectar Mysql:" .$conexao->connect_error;
    exit();
}
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
    <form name="Cliente" method="post" action="inserirVeiculo.php">
        <fieldset>
            <h2>Cadastro de Veículos</h2>
            <div>
                <label>Placa do veículo <input type="text" name="veiculoPlaca" placeholder="Placa" required></label>
                <label>Descrição do Veículo <input type="text" name="veiculoDescricao" placeholder="Descrição" required></label>  
                <label> Selecione a Marca: <select name="veiculoMarca"> </label>
               
                    <?php
                        $sql = "SELECT marca_codigo, marca_nome FROM tbmarca";//relacionados ao banco
                        $resultado = $conexao->query($sql);
                        if ($resultado->num_rows > 0) {
                            
                           foreach ($resultado as $row) {
                                $cod = $row['marca_codigo'];
                                $nome = $row['marca_nome'];
                                echo "<option value= '$cod' >   $nome</option>";
                            }
                        }
              
                    ?>
                </select>
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