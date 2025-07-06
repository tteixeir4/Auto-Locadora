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
    <title>Nova Locação</title>
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
    <form name="Locacao" method="post" action="inserirLocacao.php">
        <fieldset>
            <h2>Nova Locação</h2>
            <label> Selecione o Cliente: <select name="clienteNome"> </label>

            <?php
                   $sql = "SELECT cliente_cpf, cliente_nome FROM tbcliente";//relacionados ao banco
                   $resultado = $conexao->query($sql);
                   if ($resultado->num_rows > 0) {
                       
                      foreach ($resultado as $row) {
                           $cpf = $row['cliente_cpf'];
                           $nome = $row['cliente_nome'];
                           echo "<option value= '$cpf' >   $nome</option>";
                       }
                   }
         
               ?>
               <br>
                </select>
            <div>
                <label>Data de início: <input type="date" name="dataInicio" required></label>
                <label>Data do fim: <input type="date" name="dataFim"></label>
            </div>
            <label> Selecione o Veículo: <select name="veiculoNome"> </label>
               
               <?php
                   $sql = "SELECT veiculo_placa, veiculo_descricao FROM tbveiculo";//relacionados ao banco
                   $resultado = $conexao->query($sql);
                   if ($resultado->num_rows > 0) {
                       
                      foreach ($resultado as $row) {
                           $placa = $row['veiculo_placa'];
                           $descricao = $row['veiculo_descricao'];
                           echo "<option value= '$placa' >   $descricao</option>";
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