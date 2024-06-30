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

  $setor = null;
  $id = null;
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT s.cd_setor, s.nome, s.cd_unidade, u.nome AS nomeUnidade FROM setor s INNER JOIN unidade u ON s.cd_unidade = u.cd_unidade WHERE s.cd_setor = $id");
    if ($result->num_rows > 0) {
      $setor = $result->fetch_assoc();
    }
  }

  if (isset($_POST['submit'])) {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $fk_id_unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if (!empty($id)) {
      $sql = "UPDATE setor SET nome = '$nome', cd_unidade = '$fk_id_unidade' WHERE cd_setor = $id";
    } else {
      $sql = "INSERT INTO setor (nome, cd_unidade) VALUES ('$nome', '$fk_id_unidade')";
    }

    if ($conn->query($sql) === TRUE) {
      header("Location: consulta_setor.php");
      exit();
    } else {
      echo "Erro: " . $conn->error;
    }
  }

  if (isset($_POST['delete'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if (!empty($id)) {
        $check_sql = "SELECT COUNT(*) AS total FROM pessoa_fisica WHERE cd_setor = $id";
        $check_result = $conn->query($check_sql);
        $row = $check_result->fetch_assoc();

        if ($row['total'] > 0) {
            echo "<script>alert('Não é possível excluir este setor porque há pessoas físicas associadas a ele.');</script>";
        } else {
            $sql = "DELETE FROM setor WHERE cd_setor = $id";

            if ($conn->query($sql) === TRUE) {
                header("Location: consulta_setor.php");
                exit();
            } else {
                echo "Erro: " . $conn->error;
            }
        }
    }
  }
?>

<?php 
  $sql = "SELECT cd_unidade, nome FROM unidade";
  $result = $conn->query($sql);
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Setor</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/Recursos Humanos/js/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="/Recursos Humanos/js/main.js"></script>
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

    <b class="d-flex justify-content-center">Setor</b><br>

    <form method="post" action="setor.php">
    <input type="hidden" name="id" value="<?php echo $setor ? $setor['cd_setor'] : ''; ?>">
      <div class="row g-3 d-flex justify-content-center">
        <div class="col-sm-4">
          <label>Nome:</label>
          <input type="text" class="form-control border border-dark" aria-label="Nome" name="nome" value="<?php echo $setor ? $setor['nome'] : ''; ?>">
        </div>
      </div>

      <br>

      <div class="row g-3 d-flex justify-content-center">
        <div class="col-sm-4">
          <select class="form-select border border-dark" name="unidade">
            <option value="" disabled selected>Selecionar Unidade Existente</option>
            <?php
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $selected = ($setor && $setor['cd_unidade'] == $row['cd_unidade']) ? 'selected' : '';
                  echo "<option value='" . $row['cd_unidade'] . "' $selected>" . $row['nome'] . "</option>";
                }
              }
            ?>
          </select>
        </div>
      </div>

      <br>

      <div class="row g-3 d-flex justify-content-center">
        <div class="col-sm-2">
          <button class="form-control btn btn-danger" type="submit" name="delete" onclick="return confirmDelete()">Deletar</button>
        </div>
        <div class="col-sm-2">
          <button class="form-control btn btn-success" type="submit" value="submit" name="submit">Cadastrar</button>
        </div>
      </div>
    </form>

    <script>
        function confirmDelete() {
          var result = confirm("Tem certeza que deseja excluir este setor? Esta ação não poderá ser desfeita.");
          if (result) {
              return true;
          } else {
              return false;
          }
        }
    </script>

  </body>
</html>
