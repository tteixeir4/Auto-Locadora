<?php
$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");
$placa = $_GET['placa'];
$sql = "SELECT * FROM tbveiculo WHERE veiculo_placa = '$placa'";
$resultado = $conexao->query($sql);
$row = $resultado->fetch_assoc();

$sqlMarcas = "SELECT * FROM tbmarca";
$marcasResult = $conexao->query($sqlMarcas);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="gerenciar.css">
</head>
<body>
    <h2>Editar Veiculo</h2>
    <form method="POST" action="editarVeiculo.php">
        <fieldset>
            <label>Placa <input type="text" name="veiculoPlaca" value="<?php echo $row['veiculo_placa']; ?>" readonly></label><br>
            <label>Marca
                <select name="veiculoMarca">
                    <?php while ($marca = $marcasResult->fetch_assoc()): ?>
                        <option value="<?php echo $marca['marca_codigo']; ?>" 
                            <?php if ($row['veiculo_marca'] == $marca['marca_codigo']) echo 'selected'; ?>>
                            <?php echo $marca['marca_nome']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label><br>
            <label>Descrição <input type="text" name="veiculoDescricao" value="<?php echo $row['veiculo_descricao']; ?>"></label><br>
            <button>Atualizar</button>
        </fieldset>
    </form>
</body>
</html>
