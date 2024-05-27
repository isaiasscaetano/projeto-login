<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .mensagem {
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    require_once 'conecta.php';

    // Verifica se os dados foram enviados corretamente via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"]) && isset($_POST["senha"]) && isset($_POST["data"])) {
        // Acessa os dados do formulário
        $login = $_POST["login"];
        $senha = md5($_POST["senha"]); // Evite usar MD5 para senhas em produção
        $data = $_POST["data"];

        // Prepara e executa a consulta SQL
        $query = "INSERT INTO user (login, senha, data) VALUES (:login, :senha, :data)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':data', $data);
        $stmt->execute();

        // Exibe a mensagem de sucesso
        $mensagem = "Dados inseridos com sucesso";
    }
    ?>

    <div class="mensagem"><?php if (isset($mensagem)) echo $mensagem; ?></div>
    <?php if (isset($mensagem)) : ?>
        <div style="text-align: center;">
            <button class="btn" onclick="window.location.href = 'seleciona.php';">Ir para seleciona.php</button>
        </div>
    <?php endif; ?>
</body>
</html>
