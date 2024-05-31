<!DOCTYPE html>
<html>
<head>
  <title>Tabela de Usuários</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
      padding: 20px 0;
      margin: 0;
      background-color: #4CAF50;
      color: white;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
    }
    .btn-container {
      text-align: center;
      padding: 20px 0;
    }
    .btn {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 3px;
      text-decoration: none;
    }
    .btn:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Tabela de Usuários</h2>
    <table>
      <tr>
        <th>id_user</th>
        <th>Login</th>
        <th>Senha</th>
        <th>Data</th> 
        <th>Ação</th>
      </tr>
      <?php
      require_once 'conecta.php';

      // Verifica se houve uma solicitação POST para exclusão
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir'])) {
          $id_excluir = $_POST['excluir'];

          // Query para excluir o registro com o ID especificado
          $query_excluir = "DELETE FROM user WHERE id_user = :id";
          $stmt_excluir = $pdo->prepare($query_excluir);
          $stmt_excluir->bindParam(':id', $id_excluir);

          if ($stmt_excluir->execute()) {
              echo "<script>alert('Registro excluído com sucesso.');</script>";
          } else {
              echo "<script>alert('Erro ao excluir registro.');</script>";
          }
      }

      // Carrega os dados dos usuários
      $query = "SELECT * FROM user";
      $stmt = $pdo->prepare($query);
      $stmt->execute();

      while($result = $stmt->fetch()){
        echo "<tr>";
        echo "<td>". $result['id_user'] ."</td>";
        echo "<td>". $result['login'] ."</td>";
        echo "<td>".  $result['senha'] ."</td>";
        echo "<td>". $result['data'] ."</td>";
        echo "<td>
              <form method='post' style='display: inline;'>
                  <input type='hidden' name='excluir' value='". $result['id_user'] ."'>
                  <button type='submit'>Excluir</button>
              </form>

              <form method='get' action='editar_usuario.php' style='display: inline; margin-left: 5px;'>
                  <input type='hidden' name='id' value='". $result['id_user'] ."'> <!-- Passando o ID do usuário como um parâmetro GET -->
                  <button type='submit'>Alterar</button>
              </form>
            </td>";
        echo "</tr>";  
      }

      // Fecha as conexões e libera os recursos
      $stmt = null;
      $pdo = null;
      ?>
    </table>
    <div class="btn-container">
      <a href="editar
