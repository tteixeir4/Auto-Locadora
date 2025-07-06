<?php
$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");
$matricula = $_GET['matricula'];
$sql = "SELECT * FROM tbfuncionario WHERE funcionario_matricula = '$matricula'";
$resultado = $conexao->query($sql);
$row = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="gerenciar.css">
</head>
<body>
    <h2>Editar Cliente</h2>
    <form method="POST" action="editarFuncionario.php">
        <fieldset>
            <label><input type="hidden" name="funcionario_matricula" value="<?php echo $row['funcionario_matricula']; ?>"></label></br>
            <label>Nome <input type="text" name="funcionario_nome" value="<?php echo $row['funcionario_nome']; ?>"></label><br>
            <label>Senha <input type="text" name="funcionario_senha" value="<?php echo $row['funcionario_senha']; ?>"></label><br>
            <button>Atualizar</button>
        </fieldset>
    </form>
</body>
</html>
