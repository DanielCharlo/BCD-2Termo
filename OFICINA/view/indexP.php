<?php
require_once __DIR__ . '/../Controller/PecaController.php';

$controller = new PecaController();

// Processar exclusão
if (isset($_GET['delete'])) {
    $controller->deletar($_GET['delete']);
    exit;
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'salvar') {
        $controller->criar($_POST['nome_peca'], $_POST['valor_peca'], $_POST['quantidade_estoque']);
        exit;
    }

    if ($_POST['acao'] === 'editar') {
        $controller->atualizar($_POST['id'], $_POST['nome_peca'], $_POST['valor_peca'], $_POST['quantidade_estoque']);
        exit;
    }
}

// Buscar peça para edição
$pecaEditando = null;
if (isset($_GET['edit'])) {
    $pecaEditando = $controller->buscarPorId($_GET['edit']);
}

// Listar todas as peças
$lista = $controller->listar();

// Processar mensagens
$msg = '';
$msgTipo = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'sucesso':
            $msg = 'Peça cadastrada com sucesso!';
            $msgTipo = 'success';
            break;
        case 'atualizado':
            $msg = 'Peça atualizada com sucesso!';
            $msgTipo = 'success';
            break;
        case 'deletado':
            $msg = 'Peça excluída com sucesso!';
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
    <title>Cadastro de Peças</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }
        .header {
            margin-bottom: 20px;
        }
        .header a {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .header a:hover {
            background: #0056b3;
        }
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
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
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
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
        }
        .btn-cancelar:hover {
            background: #5a6268;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
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
        .estoque-baixo {
            background-color: #fff3cd;
        }
    </style>
</head>
<body>

<div class="header">
    <a href="index.php">← Voltar ao Menu Principal</a>
    <h1>Cadastro de Peças</h1>
</div>

<?php if ($msg): ?>
    <div class="mensagem <?= $msgTipo ?>">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<form method="POST" id="formPeca">
    <input type="hidden" name="id" id="pecaId" value="<?= $pecaEditando ? $pecaEditando->getId() : '' ?>">

    <label>Nome da Peça:</label>
    <input type="text" name="nome_peca" id="nome_peca" 
           value="<?= $pecaEditando ? htmlspecialchars($pecaEditando->getNomePeca()) : '' ?>" required><br>

    <label>Valor (R$):</label>
    <input type="number" name="valor_peca" id="valor_peca" step="0.01" min="0"
           value="<?= $pecaEditando ? htmlspecialchars($pecaEditando->getValorPeca()) : '' ?>" required><br>

    <label>Quantidade em Estoque:</label>
    <input type="number" name="quantidade_estoque" id="quantidade_estoque" min="0"
           value="<?= $pecaEditando ? htmlspecialchars($pecaEditando->getQuantidadeEstoque()) : '0' ?>" required><br>

    <button type="submit" name="acao" value="<?= $pecaEditando ? 'editar' : 'salvar' ?>">
        <?= $pecaEditando ? 'Atualizar' : 'Salvar' ?>
    </button>
    
    <?php if ($pecaEditando): ?>
        <a href="indexP.php" class="btn-cancelar">Cancelar</a>
    <?php endif; ?>
</form>

<h2>Peças cadastradas</h2>

<?php if (empty($lista)): ?>
    <p>Nenhuma peça cadastrada ainda.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome da Peça</th>
            <th>Valor (R$)</th>
            <th>Quantidade em Estoque</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($lista as $p): ?>
        <tr class="<?= $p->getQuantidadeEstoque() <= 5 ? 'estoque-baixo' : '' ?>">
            <td><?= htmlspecialchars($p->getId()) ?></td>
            <td><?= htmlspecialchars($p->getNomePeca()) ?></td>
            <td>R$ <?= number_format($p->getValorPeca(), 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($p->getQuantidadeEstoque()) ?></td>
            <td class="acoes">
                <a href="?edit=<?= $p->getId() ?>" class="btn-editar">Editar</a>
                <a href="?delete=<?= $p->getId() ?>" class="btn-excluir" 
                   onclick="return confirm('Tem certeza que deseja excluir esta peça?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (!urlParams.has('edit')) {
            document.getElementById('formPeca').reset();
            document.getElementById('pecaId').value = '';
        }
    });
</script>

</body>
</html>

