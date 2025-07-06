<?php
$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

$codigo = $_GET['codigo'];
$sql = "SELECT * FROM tblocacao WHERE locacao_codigo = '$codigo'";
$resultado = $conexao->query($sql);
$row = $resultado->fetch_assoc();
$sqlClientes = "SELECT cliente_cpf, cliente_nome FROM tbcliente";
$clientes = $conexao->query($sqlClientes);
$sqlVeiculos = "SELECT veiculo_placa, veiculo_descricao FROM tbveiculo";
$veiculos = $conexao->query($sqlVeiculos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Locação</title>
    <link rel="stylesheet" href="gerenciar.css">
</head>
<body>
    <h2>Editar Locação</h2>
    <form method="POST" action="editarLocacao.php">
        <fieldset>
            <input type="hidden" name="codigo" value="<?= $row['locacao_codigo']; ?>">
            <input type="hidden" name="cliente" value="<?= $row['locacao_cliente']; ?>">
            <input type="hidden" name="veiculo" value="<?= $row['locacao_veiculo']; ?>">
            <label>Data de Início <input type="date" name="dataInicio" value="<?= $row['locacao_data_inicio']; ?>">
            </label>
            <br>
            <label>Data de Fim <input type="date" name="dataFim" value="<?= $row['locacao_data_fim']; ?>">
            </label>
            <br>
            <button>Atualizar</button>
        </fieldset>
    </form>
</body>
</html>
