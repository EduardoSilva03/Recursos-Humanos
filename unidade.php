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

  if (isset($_POST['submit']))
  {

  $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
  $razao_social = isset($_POST['razao_social']) ? $_POST['razao_social'] : '';
  $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $site = isset($_POST['site']) ? $_POST['site'] : '';
  $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
  $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : '';
  $uf = isset($_POST['uf']) ? $_POST['uf'] : '';
  $logradouro = isset($_POST['logradouro']) ? $_POST['logradouro'] : '';
  $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
  $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : '';
  $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';

  $string_sql = mysqli_query($conn, "INSERT INTO unidade (cnpj, razao_social, nome, email, site, cep, municipio, uf, logradouro, numero, complemento, bairro) 
  VALUES ('$cnpj', '$razao_social', '$nome', '$email', '$site', '$cep', '$municipio', '$uf', '$logradouro', '$numero', '$complemento', '$bairro')");
  }

  ?>

  <?php 
  
  $sql = "SELECT nome FROM unidade";
  $result = $conn->query($sql);
  
  ?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Unidade</title>
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
            <li class="nav-item dropdown">
              <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Controle
              </button>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="/Recursos Humanos/controle_ponto.php">Controle de Ponto</a></li>
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

<b class="d-flex justify-content-center">Unidade</b><br>

<div class="row g-3 d-flex justify-content-center">
    <div class="col-sm-4">
        <select class="form-select border border-dark" id="floatingSelect" aria-label="Floating label select example" name="unidade">
        <option value="" disabled selected>Selecionar Unidade Existente</option>
            <?php
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
              }
            }
            ?>
        </select>
    </div>
</div>

<br>

<form method="post" action="unidade.php">
<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-1">
        <label>Código:</label>
        <input type="text" class="form-control border border-dark" aria-label="Código" disabled=true id="codigo">
      </div>
      <div class="col-sm-3">
        <label>CNPJ:</label>
        <input type="text" class="form-control border border-dark" aria-label="cnpj" name="cnpj", id="cnpj">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>Razão Social:</label>
        <input type="text" class="form-control border border-dark" aria-label="Razão Social" name="razao_social">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>Nome:</label>
        <input type="text" class="form-control border border-dark" aria-label="Nome" name="nome">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>E-mail:</label>
        <input type="text" class="form-control border border-dark" aria-label="E-mail" name="email">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>Site:</label>
        <input type="text" class="form-control border border-dark" aria-label="Site" name="site">
      </div>
</div>

<br>

<b class="d-flex justify-content-center">Endereço</b><br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-1">
        <label>CEP:</label>
        <input type="text" class="form-control border border-dark" aria-label="Cep" id="cep" name="cep">
      </div>
      <div class="col-sm-1">
        <br>
        <button type="button" class="form-control btn btn-outline-secondary" onclick="consultaCep()">Buscar</button>
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-3">
        <label>Município:</label>
        <input type="text" class="form-control border border-dark" aria-label="Município" name="municipio" id="municipio">
      </div>
      <div class="col-sm-1">
        <label>UF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Uf" name="uf" id="uf">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-3">
        <label>Logradouro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Logradouro" name="logradouro" id="logradouro">
      </div>
      <div class="col-sm-1">
        <label>Número:</label>
        <input type="text" class="form-control border border-dark" aria-label="Número" name="numero">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Complemento:</label>
        <input type="text" class="form-control border border-dark" aria-label="Complemento" name="complemento">
      </div>
      <div class="col-sm-2">
        <label>Bairro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Bairro" id="bairro" name="bairro">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
  <div class="col-sm-2">
    <br>
    <button type="button" class="form-control btn btn btn-danger">Deletar</button>
  </div>
  <div class="col-sm-2">
    <br>
    <button class="form-control btn btn btn-success" type="submit" value="submit" name="submit">Cadastrar</button>
  </div>
</div>
</form>

  </body>
</html>