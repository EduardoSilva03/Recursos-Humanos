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

$unidade = null;
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $conn->query("SELECT * FROM unidade WHERE cd_unidade = $id");
  if ($result->num_rows > 0) {
    $unidade = $result->fetch_assoc();
  }
}

if (isset($_POST['submit'])) {
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
  $id = isset($_POST['id']) ? $_POST['id'] : '';

  if (!empty($id)) {
    $sql = "UPDATE unidade SET cnpj = '$cnpj', razao_social = '$razao_social', nome = '$nome', email = '$email', site = '$site', cep = '$cep', municipio = '$municipio', uf = '$uf', logradouro = '$logradouro', bairro = '$bairro', numero = '$numero', complemento = '$complemento' WHERE cd_unidade = $id";
  } else {
    $sql = "INSERT INTO unidade (cnpj, razao_social, nome, email, site, cep, municipio, uf, logradouro, bairro, numero, complemento) VALUES ('$cnpj', '$razao_social', '$nome', '$email', '$site', '$cep', '$municipio', '$uf', '$logradouro', '$bairro', '$numero', '$complemento')";
  }

  if ($conn->query($sql) === TRUE) {
    header("Location: consulta_unidade.php");
    exit();
  } else {
    echo "Erro: " . $conn->error;
  }
}

if (isset($_POST['delete'])) {
  $id = isset($_POST['id']) ? $_POST['id'] : '';

  if (!empty($id)) {
    $sql = "DELETE FROM unidade WHERE cd_unidade = $id";

    if ($conn->query($sql) === TRUE) {
      header("Location: consulta_unidade.php");
      exit();
    } else {
      echo "Erro: " . $conn->error;
    }
  
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

<b class="d-flex justify-content-center">Unidade</b><br>

<form method="post" action="unidade.php">
<input type="hidden" name="id" value="<?php echo $unidade ? $unidade['cd_unidade'] : ''; ?>">
<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>CNPJ:</label>
        <input type="text" class="form-control border border-dark" aria-label="cnpj" name="cnpj", id="cnpj" value="<?php echo $unidade ? $unidade['cnpj'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>Razão Social:</label>
        <input type="text" class="form-control border border-dark" aria-label="Razão Social" name="razao_social" value="<?php echo $unidade ? $unidade['razao_social'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>Nome:</label>
        <input type="text" class="form-control border border-dark" aria-label="Nome" name="nome" value="<?php echo $unidade ? $unidade['nome'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>E-mail:</label>
        <input type="text" class="form-control border border-dark" aria-label="E-mail" name="email" value="<?php echo $unidade ? $unidade['email'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>Site:</label>
        <input type="text" class="form-control border border-dark" aria-label="Site" name="site" value="<?php echo $unidade ? $unidade['site'] : ''; ?>">
      </div>
</div>

<br>

<b class="d-flex justify-content-center">Endereço</b><br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-1">
        <label>CEP:</label>
        <input type="text" class="form-control border border-dark" aria-label="Cep" id="cep" name="cep" value="<?php echo $unidade ? $unidade['cep'] : ''; ?>">
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
        <input type="text" class="form-control border border-dark" aria-label="Município" name="municipio" id="municipio" value="<?php echo $unidade ? $unidade['municipio'] : ''; ?>">
      </div>
      <div class="col-sm-1">
        <label>UF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Uf" name="uf" id="uf" value="<?php echo $unidade ? $unidade['uf'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-3">
        <label>Logradouro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Logradouro" name="logradouro" id="logradouro" value="<?php echo $unidade ? $unidade['logradouro'] : ''; ?>">
      </div>
      <div class="col-sm-1">
        <label>Número:</label>
        <input type="text" class="form-control border border-dark" aria-label="Número" name="numero" value="<?php echo $unidade ? $unidade['numero'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Complemento:</label>
        <input type="text" class="form-control border border-dark" aria-label="Complemento" name="complemento" value="<?php echo $unidade ? $unidade['complemento'] : ''; ?>">
      </div>
      <div class="col-sm-2">
        <label>Bairro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Bairro" id="bairro" name="bairro" value="<?php echo $unidade ? $unidade['bairro'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
  <div class="col-sm-2">
    <br>
    <button type="submit" name="delete" class="form-control btn btn btn-danger">Deletar</button>
  </div>
  <div class="col-sm-2">
    <br>
    <button class="form-control btn btn btn-success" type="submit" value="submit" name="submit">Cadastrar</button>
  </div>
</div>
</form>

  </body>
</html>