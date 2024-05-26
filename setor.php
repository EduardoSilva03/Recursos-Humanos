<?php 
  session_start();
  include_once('./conn.php');

  if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
  }

  if (isset($_POST['submit'])) {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $fk_id_unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';

    if ($nome && $fk_id_unidade) {
      $string_sql = mysqli_query($conn, "INSERT INTO setor (nome, cd_unidade) 
        VALUES ('$nome', '$fk_id_unidade')");
      if (!$string_sql) {
        echo "Erro ao cadastrar setor: " . mysqli_error($conn);
      } else {
        echo "Setor cadastrado com sucesso.";
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
              <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Administrativo
              </button>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="/Recursos Humanos/unidade.php">Unidade</a></li>
                <li><a class="dropdown-item" href="/Recursos Humanos/setor.php">Setor</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Profissional
              </button>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="/Recursos Humanos/pessoa_fisica.php">Pessoa Física</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <br>

    <b class="d-flex justify-content-center">Setor</b><br>

    <form method="post" action="setor.php">
      <div class="row g-3 d-flex justify-content-center">
        <div class="col-sm-1">
          <label>Código:</label>
          <input type="text" class="form-control border border-dark" aria-label="Código" disabled>
        </div>
        <div class="col-sm-3">
          <label>Nome:</label>
          <input type="text" class="form-control border border-dark" aria-label="Nome" name="nome">
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
                  echo "<option value='" . $row['cd_unidade'] . "'>" . $row['nome'] . "</option>";
                }
              }
            ?>
          </select>
        </div>
      </div>

      <br>

      <div class="row g-3 d-flex justify-content-center">
        <div class="col-sm-2">
          <button class="form-control btn btn-success" type="submit" value="submit" name="submit">Cadastrar</button>
        </div>
        <div class="col-sm-2">
          <button class="form-control btn btn-danger" type="button">Deletar</button>
        </div>
      </div>
    </form>

  </body>
</html>
