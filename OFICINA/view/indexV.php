<?php
require_once __DIR__ . '/../Controller/VeiculoController.php';
require_once __DIR__ . '/../model/ClienteDAO.php';

$controller = new VeiculoController();
$clienteDAO = new ClienteDAO();

// Processar exclusão
if (isset($_GET['delete'])) {
    $controller->deletar($_GET['delete']);
    exit;
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'salvar') {
        $controller->criar($_POST['id_cliente'], $_POST['placa'], $_POST['marca'], $_POST['modelo'], $_POST['ano']);
        exit;
    }

    if ($_POST['acao'] === 'editar') {
        $controller->atualizar($_POST['id'], $_POST['id_cliente'], $_POST['placa'], $_POST['marca'], $_POST['modelo'], $_POST['ano']);
        exit;
    }
}

// Buscar veículo para edição
$veiculoEditando = null;
if (isset($_GET['edit'])) {
    $veiculoEditando = $controller->buscarPorId($_GET['edit']);
}

// Listar todos os veículos
$lista = $controller->listar();
$clientes = $clienteDAO->listar();

// Processar mensagens
$msg = '';
$msgTipo = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'sucesso':
            $msg = 'Veículo cadastrado com sucesso!';
            $msgTipo = 'success';
            break;
        case 'atualizado':
            $msg = 'Veículo atualizado com sucesso!';
            $msgTipo = 'success';
            break;
        case 'deletado':
            $msg = 'Veículo excluído com sucesso!';
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
    <title>Cadastro de Veículos</title>
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
        input[type="number"],
        select {
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
    </style>
</head>
<body>

<div class="header">
    <a href="index.php">← Voltar ao Menu Principal</a>
    <h1>Cadastro de Veículos</h1>
</div>

<?php if ($msg): ?>
    <div class="mensagem <?= $msgTipo ?>">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<form method="POST" id="formVeiculo">
    <input type="hidden" name="id" id="veiculoId" value="<?= $veiculoEditando ? $veiculoEditando->getId() : '' ?>">

    <label>Cliente:</label>
    <select name="id_cliente" id="id_cliente" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c->getId() ?>" 
                    <?= $veiculoEditando && $veiculoEditando->getIdCliente() == $c->getId() ? 'selected' : '' ?>>
                <?= htmlspecialchars($c->getNome()) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Placa:</label>
    <input type="text" name="placa" id="placa" value="<?= $veiculoEditando ? htmlspecialchars($veiculoEditando->getPlaca()) : '' ?>" required><br>

    <label>Marca:</label>
    <input type="text" name="marca" id="marca" value="<?= $veiculoEditando ? htmlspecialchars($veiculoEditando->getMarca()) : '' ?>" required><br>

    <label>Modelo:</label>
    <input type="text" name="modelo" id="modelo" value="<?= $veiculoEditando ? htmlspecialchars($veiculoEditando->getModelo()) : '' ?>" required><br>

    <label>Ano:</label>
    <input type="number" name="ano" id="ano" value="<?= $veiculoEditando ? htmlspecialchars($veiculoEditando->getAno()) : '' ?>" required min="1900" max="2100"><br>

    <button type="submit" name="acao" value="<?= $veiculoEditando ? 'editar' : 'salvar' ?>">
        <?= $veiculoEditando ? 'Atualizar' : 'Salvar' ?>
    </button>
    
    <?php if ($veiculoEditando): ?>
        <a href="indexV.php" class="btn-cancelar">Cancelar</a>
    <?php endif; ?>
</form>

<h2>Veículos cadastrados</h2>

<?php if (empty($lista)): ?>
    <p>Nenhum veículo cadastrado ainda.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Ações</th>
        </tr>

        <?php 
        // Criar array de clientes por ID para busca rápida
        $clientesPorId = [];
        foreach ($clientes as $c) {
            $clientesPorId[$c->getId()] = $c;
        }
        
        foreach ($lista as $v): 
            $clienteVeiculo = isset($clientesPorId[$v->getIdCliente()]) ? $clientesPorId[$v->getIdCliente()] : null;
        ?>
        <tr>
            <td><?= htmlspecialchars($v->getId()) ?></td>
            <td><?= $clienteVeiculo ? htmlspecialchars($clienteVeiculo->getNome()) : 'ID: ' . $v->getIdCliente() ?></td>
            <td><?= htmlspecialchars($v->getPlaca()) ?></td>
            <td><?= htmlspecialchars($v->getMarca()) ?></td>
            <td><?= htmlspecialchars($v->getModelo()) ?></td>
            <td><?= htmlspecialchars($v->getAno()) ?></td>
            <td class="acoes">
                <a href="?edit=<?= $v->getId() ?>" class="btn-editar">Editar</a>
                <a href="?delete=<?= $v->getId() ?>" class="btn-excluir" 
                   onclick="return confirm('Tem certeza que deseja excluir este veículo?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (!urlParams.has('edit')) {
            document.getElementById('formVeiculo').reset();
            document.getElementById('veiculoId').value = '';
        }
    });
</script>

</body>
</html>

