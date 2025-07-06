<?php
$termo = $_GET['termo'] ?? '';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if (!$conexao || $conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$sql = "SELECT * FROM tbfuncionario WHERE funcionario_matricula LIKE ? OR funcionario_nome LIKE ?";
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
        echo "<div class='item'><strong>Matrícula:</strong> " . $row['funcionario_matricula'] . " | <strong>Nome:</strong> " . $row['funcionario_nome'] . "</div>";
    }
} else {
    echo "<div class='item'>Nenhum resultado encontrado.</div>";
}

$conexao->close();
?>
