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

  $nomeFuncionario = "";
  if (isset($_POST['nomeFuncionario'])) {
    $nomeFuncionario = $_POST['nomeFuncionario'];
  }

  $sql = "SELECT pf.cd_pessoa, pf.nome, pf.rg, pf.cpf, pf.data_nascimento, u.nome AS Unidade, s.nome as Setor 
          FROM pessoa_fisica pf 
          INNER JOIN unidade u ON pf.cd_unidade = u.cd_unidade 
          INNER JOIN setor s on pf.cd_setor = s.cd_setor";
  
  if ($nomeFuncionario != "") {
    $sql .= " WHERE pf.nome LIKE '%" . $conn->real_escape_string($nomeFuncionario) . "%'";
  }

  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Pessoa Física</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt-br.js"></script> <!-- Adicionando arquivo de localização -->
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
        <!-- Botão de logoff -->
        <form class="d-flex" method="POST">
          <button class="btn btn-outline-light me-2" type="submit" name="logout">Logoff</button>
        </form>
      </div>
    </nav>

<br>

<div class="container">
    <h2>Consulta de Pessoa Física</h2>
    <form method="POST" class="row g-3">
        <div class="col-auto">
            <label for="nomeFuncionario" class="visually-hidden">Nome do Funcionário</label>
            <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" placeholder="Nome do Funcionário">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>RG</th>
                <th>CPF</th>
                <th>Data nascimento</th>
                <th>Unidade</th>
                <th>Setor</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['cd_pessoa']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['rg']; ?></td>
                    <td><?php echo $row['cpf']; ?></td>
                    <td><?php echo $row['data_nascimento']; ?></td>
                    <td><?php echo $row['Unidade']; ?></td>
                    <td><?php echo $row['Setor']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
