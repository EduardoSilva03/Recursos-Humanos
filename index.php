<?php 
  session_start();
  include_once('./conn.php');

  if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
  }

  if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
  }
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciamento de Recursos Humanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      body {
        background-image: url('img/home-banner-1-wp.webp');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
      }
      .navbar {
        margin-bottom: 20px; /* Adicione margem inferior para evitar sobreposição com o conteúdo */
      }
      .container {
        padding-top: 60px; /* Ajuste o padding superior para evitar que o conteúdo fique muito próximo do topo */
      }
      /* Estilo adicional pode ser adicionado conforme necessário */
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/Recursos Humanos/index.php">Recursos Humanos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Administrativo
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/Recursos Humanos/unidade.php">Unidade</a></li>
                <li><a class="dropdown-item" href="/Recursos Humanos/setor.php">Setor</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profissional
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/Recursos Humanos/pessoa_fisica.php">Pessoa Física</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Controle
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/Recursos Humanos/controle_ponto.php">Controle de Ponto</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Consultar
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/Recursos Humanos/consulta_pessoa_fisica.php">Pessoa Física</a></li>
                <li><a class="dropdown-item" href="/Recursos Humanos/consulta_unidade.php">Unidade</a></li>
                <li><a class="dropdown-item" href="/Recursos Humanos/consulta_setor.php">Setor</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- Botão de logoff -->
        <form class="d-flex" method="POST">
          <button class="btn btn-outline-light me-2" type="submit" name="logout">Logoff</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <h1 class="display-4 text-white mt-5">Bem-vindo à Gerenciamento de Recursos Humanos</h1>
          <p class="lead text-white mb-5">Aqui você encontra soluções eficientes para sua empresa.</p>
          <!-- Exemplo de seção adicional -->
          <div class="row">
            <div class="col-md-4">
              <h3 class="text-white">Serviços</h3>
              <p class="text-white">Oferecemos uma variedade de serviços para otimizar sua gestão de recursos humanos.</p>
            </div>
            <div class="col-md-4">
              <h3 class="text-white">Clientes</h3>
              <p class="text-white">Atendemos empresas de todos os tamanhos e setores.</p>
            </div>
            <div class="col-md-4">
              <h3 class="text-white">Contato</h3>
              <p class="text-white">Entre em contato conosco para saber mais.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
