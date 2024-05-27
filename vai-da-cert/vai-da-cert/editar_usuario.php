<?php
require_once 'conecta.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Query para selecionar o usuário com o ID especificado
    $query = "SELECT * FROM user WHERE id_user = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id_user);
    $stmt->execute();
    $user = $stmt->fetch();
}

// Processar o formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_user = $_POST['id'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $data = $_POST['data'];

    // Hash da senha com MD5
    $senha_hashed = md5($senha);

    // Query para atualizar o usuário com os novos dados
    $query = "UPDATE user SET login = :login, senha = :senha, data = :data WHERE id_user = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':senha', $senha_hashed); // Use a senha com hash MD5
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':id', $id_user);

    if ($stmt->execute()) {
        echo "<script>alert('Registro atualizado com sucesso.'); window.location.href = 'seleciona.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar registro.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Edição de Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        form {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }
        input[type="text"],
        input[type="password"],
        input[type="date"],
        button[type="submit"],
        a {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            width: calc(100% - 20px);
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            cursor: pointer;
        }
        button[type="submit"]:hover,
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">
        Login: <input type="text" name="login" value="<?php echo $user['login']; ?>">
        Senha: <input type="password" name="senha" value="<?php echo $user['senha']; ?>">
        Data: <input type="date" name="data" value="<?php echo $user['data']; ?>">
        <button type="submit">Salvar</button>
    </form>

    <a href="seleciona.php">Voltar para a tabela</a>

    <?php
    // Fecha as conexões e libera os recursos
    $stmt = null;
    $pdo = null;
    ?>
</body>
</html>
