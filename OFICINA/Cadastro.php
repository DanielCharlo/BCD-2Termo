<?php
require_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Cadastro.css">
    <title>Cadastro de Clientes</title>
</head>
<body>

    <div class="Formulario">
        <form method="POST" action="Cadastro.php">
            <label>Nome:</label>
                <input type="text" name="nome" placeholder="Digite seu nome:">

            <label>Telefone:</label>
                <input type="text" name="telefone" placeholder="Digite seu telefone:">

            <label>Documento:</label>
                <input type="text" name="documento" placeholder="Digite seu documento:">

            <label>Endereco:</label>
                <input type="text" name="endereco" placeholder="Digite seu endereco:">

            <button type="submit">Cadastrar</button>

        </form>
    </div>

</body>
</html>

<?php 
$nome = $_POST['nome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$documento = $_POST['documento'] ?? '';
$endereco = $_POST['endereco'] ?? '';

$linha=$con->prepare("insert into CLIENTE(NOME_CLIENTE,TELEFONE_CLIENTE,DOCUMENTO,ENDERECO_CLIENTE) values(?,?,?,?)");

$linha->bind_param("ssss",$nome,$telefone,$documento,$endereco);

if($linha->execute()){
    echo "<p>Sucesso</p>";
}
?>