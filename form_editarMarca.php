<?php
$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");
$codigo = $_GET['codigo'];
$sql = "SELECT * FROM tbmarca WHERE marca_codigo = '$codigo'";
$resultado = $conexao->query($sql);
$row = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Marca</title>
    <link rel="stylesheet" href="gerenciar.css">
</head>
<body>
    <h2>Editar Marca</h2>
    <form method="POST" action="editarMarca.php">
        <fieldset>
            <label><input type="hidden" name="codigoMarca" value="<?php echo $row['marca_codigo']; ?>">
            <label>Nome <input type="text" name="nomeMarca" value="<?php echo $row['marca_nome']; ?>"></label><br>
            <button>Atualizar</button>
        </fieldset>
    </form>
</body>
</html>
