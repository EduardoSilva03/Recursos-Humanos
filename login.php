<?php
session_start();
include_once('./conn.php');

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitiza e obtém as variáveis
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);
    
    // Verifica se os campos estão preenchidos
    if (empty($usuario) || empty($senha)) {
        header("Location: login.php?error=2");
        exit();
    }

    // Consulta SQL para verificar usuário e senha
    $sql = "SELECT * FROM login WHERE usuario = ? AND senha = md5(?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $usuario, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        // Se o usuário for encontrado
        if ($result->num_rows == 1) {
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=1"); // Usuário ou senha incorretos
            exit();
        }
    } else {
        // Erro de consulta
        header("Location: login.php?error=3");
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            max-width: 400px;
        }
    </style>
</head>
<body>

<div class="modal fade" id="politicaPrivacidadeModal" tabindex="-1" aria-labelledby="politicaPrivacidadeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="politicaPrivacidadeModalLabel">Política de Privacidade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>1. Objetivo</strong></p>
        <p>A presente “Política de Privacidade”...</p> <!-- Continue com o conteúdo da política -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid container-custom">
    <form class="form-container" action="login.php" method="post">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php
                if ($_GET['error'] == 1) {
                    echo "Usuário ou senha incorretos!";
                } elseif ($_GET['error'] == 2) {
                    echo "Preencha todos os campos!";
                } elseif ($_GET['error'] == 3) {
                    echo "Erro na consulta. Tente novamente!";
                }
                ?>
            </div>
        <?php endif; ?>
        
        <div class="mb-3">
            <label for="usuario" class="form-label">USUÁRIO</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">SENHA</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
            <a href="#" data-toggle="modal" data-target="#politicaPrivacidadeModal">Política de Privacidade</a>
        </div>
        <button type="submit" class="btn btn-primary">Acessar</button>
    </form>
</div>

</body>
</html>