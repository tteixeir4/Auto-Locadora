<?php
$termo = $_GET['termo'] ?? '';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if (!$conexao || $conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$sql = "SELECT * FROM tbmarca WHERE marca_codigo LIKE ? OR marca_nome LIKE ?";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

$like = "%$termo%";
$stmt->bind_param("ss", $like, $like);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'><strong>Código:</strong> " . $row['marca_codigo'] . " | <strong>Nome:</strong> " . $row['marca_nome'] . "</div>";
    }
} else {
    echo "<div class='item'>Nenhum resultado encontrado.</div>";
}

$conexao->close();
?>
