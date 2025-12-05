<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema da Oficina</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f0f0f0;
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            margin-bottom: 30px;
        }

        .links {
            display: flex;
            gap: 20px;
        }

        a {
            text-decoration: none;
            padding: 15px 25px;
            background: #333;
            color: white;
            border-radius: 8px;
            font-size: 18px;
            transition: 0.3s;
        }

        a:hover {
            background: #555;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Sistema da Oficina</h1>

    <div class="links">
        <a href="indexC.php">Cadastro de Clientes</a>
        <a href="indexV.php">Cadastro de Veículos</a>
        <a href="IndexM.php">Cadastro de Mecânicos</a>
        <a href="indexS.php">Cadastro de Serviços</a>
        <a href="indexP.php">Cadastro de Peças</a>
        <a href="indexOS.php">Ordens de Serviço</a>
    </div>
</div>

</body>
</html>
