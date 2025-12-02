<<<<<<< HEAD
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
=======
<?php
$nome = $_POST["nome"];
$email = $_POST["email"];

$conn = new mysqli("localhost", "root", "Charlo2025@", "livraria");

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
$conn->query($sql);
$conn->close();

header("Location: listar.php");
exit;
?>
>>>>>>> 25716e19cc030fa1df5aa6cd69cfc53cc9aaa70e
