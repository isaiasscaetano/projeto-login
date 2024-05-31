<?php
require_once 'conecta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $data = $_POST['data'];

    // Query para atualizar os dados do usuário com o ID especificado
    $query = "UPDATE user SET login = :login, senha = :senha, data = :data WHERE id_user = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados do usuário atualizados com sucesso.');</script>";
        // Redireciona de volta para a página de edição após a atualização
        header("Location: editar_usuario.php?id=$id");
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar dados do usuário.');</script>";
    }
}
?>
