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

  $nomeUnidade = "";
  if (isset($_POST['nomeUnidade'])) {
    $nomeUnidade = $_POST['nomeUnidade'];
  }

  $sql = "SELECT * FROM unidade";
  
  if ($nomeUnidade != "") {
    $sql .= " WHERE nome LIKE '%" . $conn->real_escape_string($nomeUnidade) . "%'";
  }

  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Unidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt-br.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        #calendar {
            height: 100%;
        }
    </style>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0" style="background-image: url(img/fundoabs.jpg);">

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
        <form class="d-flex" method="POST">
          <button class="btn btn-outline-light me-2" type="submit" name="logout">Logoff</button>
        </form>
      </div>
    </nav>

<br>

<div class="container">
    <h2>Consulta de Unidade</h2>
    <form method="POST" class="row g-3">
        <div class="col-auto">
            <label for="nomeUnidade" class="visually-hidden">Nome da Unidade</label>
            <input type="text" class="form-control" id="nomeUnidade" name="nomeUnidade" placeholder="Nome da Unidade">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>CNPJ</th>
                <th>RAZAO SOCIAL</th>
                <th>NOME</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['cd_unidade']; ?></td>
                    <td><?php echo $row['cnpj']; ?></td>
                    <td><?php echo $row['razao_social']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><a href="unidade.php?id=<?php echo $row['cd_unidade']; ?>" class="btn btn-warning">Editar</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
