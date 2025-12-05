<?php
require_once __DIR__ . '/../Controller/ClienteController.php';

$controller = new ClienteController();

// Processar exclusão
if (isset($_GET['delete'])) {
    $controller->deletar($_GET['delete']);
    exit; // O controller já faz o redirecionamento
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'salvar') {
        $controller->criar($_POST['nome'], $_POST['telefone'], $_POST['documento'], $_POST['endereco']);
        exit; // O controller já faz o redirecionamento
    }

    if ($_POST['acao'] === 'editar') {
        $controller->atualizar($_POST['id'], $_POST['nome'], $_POST['telefone'], $_POST['documento'], $_POST['endereco']);
        exit; // O controller já faz o redirecionamento
    }
}

// Buscar cliente para edição
$clienteEditando = null;
if (isset($_GET['edit'])) {
    $lista = $controller->listar();
    foreach ($lista as $c) {
        if ($c->getId() == $_GET['edit']) {
            $clienteEditando = $c;
            break;
        }
    }
}

// Listar todos os clientes
$lista = $controller->listar();

// Processar mensagens
$msg = '';
$msgTipo = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'sucesso':
            $msg = 'Cliente cadastrado com sucesso!';
            $msgTipo = 'success';
            break;
        case 'atualizado':
            $msg = 'Cliente atualizado com sucesso!';
            $msgTipo = 'success';
            break;
        case 'deletado':
            $msg = 'Cliente excluído com sucesso!';
            $msgTipo = 'success';
            break;
        case 'erro':
            $msg = 'Erro: ' . (isset($_GET['tipo']) ? htmlspecialchars($_GET['tipo']) : 'Operação falhou');
            $msgTipo = 'error';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Clientes</title>
    <style>
        .mensagem {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .mensagem.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .mensagem.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        form {
            margin-bottom: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 300px;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        button[value="editar"] {
            background: #28a745;
        }
        button[value="editar"]:hover {
            background: #218838;
        }
        .btn-cancelar {
            background: #6c757d;
            margin-left: 10px;
        }
        .btn-cancelar:hover {
            background: #5a6268;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .acoes a {
            margin-right: 10px;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
        }
        .btn-editar {
            background: #28a745;
            color: white;
        }
        .btn-editar:hover {
            background: #218838;
        }
        .btn-excluir {
            background: #dc3545;
            color: white;
        }
        .btn-excluir:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

<div style="margin-bottom: 20px;">
    <a href="index.php" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">← Voltar ao Menu Principal</a>
</div>

<h1>Cadastro de Clientes</h1>

<?php if ($msg): ?>
    <div class="mensagem <?= $msgTipo ?>">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<form method="POST" id="formCliente">
    <input type="hidden" name="id" id="clienteId" value="<?= $clienteEditando ? $clienteEditando->getId() : '' ?>">

    <label>Nome:</label>
    <input type="text" name="nome" id="nome" value="<?= $clienteEditando ? htmlspecialchars($clienteEditando->getNome()) : '' ?>" required><br>

    <label>Telefone:</label>
    <input type="text" name="telefone" id="telefone" value="<?= $clienteEditando ? htmlspecialchars($clienteEditando->getTelefone()) : '' ?>" required><br>

    <label>Documento:</label>
    <input type="text" name="documento" id="documento" value="<?= $clienteEditando ? htmlspecialchars($clienteEditando->getDocumento()) : '' ?>" required><br>

    <label>Endereço:</label>
    <input type="text" name="endereco" id="endereco" value="<?= $clienteEditando ? htmlspecialchars($clienteEditando->getEndereco()) : '' ?>" required><br>

    <button type="submit" name="acao" value="<?= $clienteEditando ? 'editar' : 'salvar' ?>">
        <?= $clienteEditando ? 'Atualizar' : 'Salvar' ?>
    </button>
    
    <?php if ($clienteEditando): ?>
        <a href="indexC.php" class="btn-cancelar" style="display: inline-block; padding: 10px 20px; text-decoration: none; color: white; border-radius: 4px;">Cancelar</a>
    <?php endif; ?>
</form>

<h2>Clientes cadastrados</h2>

<?php if (empty($lista)): ?>
    <p>Nenhum cliente cadastrado ainda.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Documento</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($lista as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c->getId()) ?></td>
            <td><?= htmlspecialchars($c->getNome()) ?></td>
            <td><?= htmlspecialchars($c->getTelefone()) ?></td>
            <td><?= htmlspecialchars($c->getDocumento()) ?></td>
            <td><?= htmlspecialchars($c->getEndereco()) ?></td>
            <td class="acoes">
                <a href="?edit=<?= $c->getId() ?>" class="btn-editar">Editar</a>
                <a href="?delete=<?= $c->getId() ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach ?>

    </table>
<?php endif; ?>

<script>
    // Limpar formulário após cancelar edição
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (!urlParams.has('edit')) {
            document.getElementById('formCliente').reset();
            document.getElementById('clienteId').value = '';
        }
    });
</script>

</body>
</html>
