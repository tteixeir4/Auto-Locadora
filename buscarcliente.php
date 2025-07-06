<?php
$termo = $_GET['termo'] ?? '';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if (!$conexao || $conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$sql = "SELECT * FROM tbcliente WHERE cliente_nome LIKE ? OR cliente_cpf LIKE ? OR cliente_endereco LIKE ?";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

$like = "%$termo%";
$stmt->bind_param("sss", $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'><strong>Nome:</strong> " . $row['cliente_nome'] . " | <strong>CPF:</strong> " . $row['cliente_cpf'] . " | <strong>Endereço:</strong> " . $row['cliente_endereco'] . "</div><br>";
    }
} else {
    echo "<div class='item'>Nenhum resultado encontrado.</div>";
}

$conexao->close();
?>
