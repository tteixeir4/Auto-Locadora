<?php
$termo = $_GET['termo'] ?? '';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if (!$conexao || $conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$sql = "
    SELECT 
        tbveiculo.veiculo_placa, 
        tbveiculo.veiculo_descricao, 
        tbveiculo.veiculo_status, 
        tbmarca.marca_nome
    FROM tbveiculo
    JOIN tbmarca ON tbveiculo.veiculo_marca = tbmarca.marca_codigo
    WHERE 
        tbveiculo.veiculo_placa LIKE ? OR 
        tbveiculo.veiculo_descricao LIKE ? OR 
        tbveiculo.veiculo_status LIKE ? OR 
        tbmarca.marca_nome LIKE ?
";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

$like = "%$termo%";
$stmt->bind_param("ssss", $like, $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'><strong>Placa:</strong> " . $row['veiculo_placa'] . " | <strong>Marca:</strong> " . $row['marca_nome'] . " | <strong>Descrição:</strong> " . $row['veiculo_descricao'] . " | <strong>Status:</strong> " . $row['veiculo_status'] . "</div><br>";
    }
} else {
    echo "<div class='item'>Nenhum resultado encontrado.</div>";
}

$conexao->close();
?>
