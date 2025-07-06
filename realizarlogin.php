<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form name="formLogin" id="formLogin" method="post" action="login.php">
        <fieldset>
            <img src="autoloc.png" width="200px" height="100px">
            <h2>Login no Sistema</h2>
            <div>
                <label>Nº Matrícula <input type="text" name="matricula" id="matricula" placeholder="Matrícula" required></label>
            </div>
                <label>Senha <input type="password" name="senha" id="senha" placeholder="Senha" required></label>
            <button type="submit" name="botao">Entrar</button>
        </fieldset>
    </form>
    <script src="validacao.js"></script>
</body>
</html>