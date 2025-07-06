<?php
$termo = $_GET['termo'] ?? '';

$conexao = new mysqli("localhost", "root", "", "bdautolocadora2025");

if (!$conexao || $conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

$sql = "
    SELECT 
        tblocacao.locacao_codigo, 
        tblocacao.locacao_veiculo, 
        tblocacao.locacao_cliente,
        tbveiculo.veiculo_descricao,
        tbcliente.cliente_cpf, 
        tbcliente.cliente_nome
    FROM tblocacao
    JOIN tbveiculo ON tblocacao.locacao_veiculo = tbveiculo.veiculo_placa
    JOIN tbcliente ON tblocacao.locacao_cliente = tbcliente.cliente_cpf
    WHERE 
        tblocacao.locacao_codigo LIKE ? OR 
        tblocacao.locacao_veiculo LIKE ? OR 
        tblocacao.locacao_cliente LIKE ? OR 
        tbveiculo.veiculo_descricao LIKE ? OR
        tbcliente.cliente_cpf LIKE ? OR
        tbcliente.cliente_nome LIKE ?
";

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

$like = "%$termo%";
$stmt->bind_param("ssssss", $like, $like, $like, $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'><strong>Código:</strong> " . $row['locacao_codigo'] . " | <strong>CPF:</strong> " . $row['cliente_cpf'] . " | <strong>Cliente:</strong> " . $row['cliente_nome'] . " | <strong>Placa:</strong> " . $row['locacao_veiculo'] . " | <strong>Veículo:</strong> " . $row['veiculo_descricao'] . "</div>";
    }
} else {
    echo "<div class='item'>Nenhum resultado encontrado.</div>";
}

$conexao->close();
?>
