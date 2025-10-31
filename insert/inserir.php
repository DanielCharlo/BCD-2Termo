<?php
// Coletando dados do formulário com segurança
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "Charlo2025@", "livros - 12-09");

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Usar prepared statement para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
$stmt->bind_param("ss", $nome, $email);

if ($stmt->execute()) {
    echo "Dados salvos com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

// Fechar conexões
$stmt->close();
$conn->close();
?>
