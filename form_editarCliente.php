<?php
$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");
$cpf = $_GET['cpf'];
$sql = "SELECT * FROM tbcliente WHERE cliente_cpf = '$cpf'";
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
    <form method="POST" action="editarCliente.php">
        <fieldset>
            <label>CPF <input type="text" name="cpf" value="<?php echo $row['cliente_cpf']; ?>" readonly></label><br>
            <label>Nome <input type="text" name="nome" value="<?php echo $row['cliente_nome']; ?>"></label><br>
            <label>Endereço <input type="text" name="endereco" value="<?php echo $row['cliente_endereco']; ?>"></label><br>
            <button>Atualizar</button>
        </fieldset>
    </form>
</body>
</html>
