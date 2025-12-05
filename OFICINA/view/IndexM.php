<?php
require_once __DIR__.'/../Controller/MecanicoController.php';
$controller = new MecanicoController();

// Excluir
if (isset($_GET['delete'])) {
    $controller->deletar($_GET['delete']);
    exit;
}

// Carregar dados pra edição
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $controller->buscarPorId($_GET['edit']);
}

// Criar ou Editar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Se tiver ID → é edição
    if (!empty($_POST['id'])) {
        $controller->editar($_POST['id'], $_POST['nome'], $_POST['especialidade'], $_POST['telefone']);
    } else {
        $controller->criar($_POST['nome'], $_POST['especialidade'], $_POST['telefone']);
    }
    exit;
}

$lista = $controller->ler();

// Processar mensagens
$msg = '';
$msgTipo = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'sucesso':
            $msg = 'Mecânico cadastrado com sucesso!';
            $msgTipo = 'success';
            break;
        case 'atualizado':
            $msg = 'Mecânico atualizado com sucesso!';
            $msgTipo = 'success';
            break;
        case 'deletado':
            $msg = 'Mecânico excluído com sucesso!';
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
    <title>Cadastro Mecanico</title>
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
    </style>
</head>
<body>

<div style="margin-bottom: 20px;">
    <a href="index.php" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">← Voltar ao Menu Principal</a>
</div>

<h2><?= $editData ? "Editar Mecânico" : "Cadastro de Funcionários" ?></h2>

<?php if ($msg): ?>
    <div class="mensagem <?= $msgTipo ?>">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<form method="POST">

    <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData->getId(); ?>">
    <?php endif; ?>

    <input type="text" name="nome" placeholder="Nome" required
        value="<?= $editData ? $editData->getNome() : '' ?>">

    <input type="text" name="especialidade" placeholder="Especialidade" required
        value="<?= $editData ? $editData->getEspecialidade() : '' ?>">

    <input type="text" name="telefone" placeholder="Telefone" required
        value="<?= $editData ? $editData->getTelefone() : '' ?>">

    <button type="submit">
        <?= $editData ? "Salvar" : "Cadastrar" ?>
    </button>
</form>

<h3>Lista de Funcionários</h3>

<table border="1">
<tr><th>Nome</th><th>Especialidade</th><th>Telefone</th><th>Status</th><th>Ações</th></tr>

<?php foreach($lista as $m): ?>
<tr>
    <td><?= $m->getNome(); ?></td>
    <td><?= $m->getEspecialidade(); ?></td>
    <td><?= $m->getTelefone(); ?></td>
    <td><?= $m->getStatus(); ?></td>
    <td>
        <a href="?edit=<?= $m->getId() ?>">Editar</a> |
        <a href="?delete=<?= $m->getId() ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>
