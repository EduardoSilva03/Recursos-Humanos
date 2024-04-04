<?php
include_once('conn.php');

if (isset($_POST['submit'])) {
    // Recupera os valores do formulário
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];

    // Consulta para verificar se o usuário existe no banco de dados
    $sql = "SELECT * FROM login WHERE matricula = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $matricula, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Usuário autenticado com sucesso, redirecione para a página de destino
        // Por exemplo:
        header("Location: index.php");
        exit();
    } else {
        // Credenciais inválidas, exiba uma mensagem de erro ou redirecione para a página de login com uma mensagem de erro
        // Por exemplo:
        header("Location: login.php?error=1");
        exit();
    }
}
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/Recursos Humanos/js/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="/Recursos Humanos/js/main.js"></script>
    <style>
        body {
            background-image: url(img/fundoabs.jpg);
        }
        .container-custom {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            max-width: 400px; /* Largura máxima do formulário */
        }
    </style>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">

    <div class="container-fluid container-custom">
        <form class="form-container" action="login.php" method="post">
            <div class="mb-3">
              <label for="matricula" class="form-label">MATRÍCULA</label>
              <input type="text" class="form-control" id="matricula" name="matricula">
            </div>
            <div class="mb-3">
              <label for="senha" class="form-label">SENHA</label>
              <input type="password" class="form-control" id="senha" name="senha">
            </div>
            <button type="submit" value="submit" name="submit" class="btn btn-primary">Acessar</button>
        </form>
    </div>

  </body>
</html>
