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

  if (isset($_POST['submit'])) {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $rg = isset($_POST['rg']) ? $_POST['rg'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $fk_id_unidade = isset($_POST['unidade']) ? $_POST['unidade'] : '';
    $fk_id_setor = isset($_POST['setor']) ? $_POST['setor'] : '';
    $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
    $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : '';
    $uf = isset($_POST['uf']) ? $_POST['uf'] : '';
    $logradouro = isset($_POST['logradouro']) ? $_POST['logradouro'] : '';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : '';
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';

    if ($nome && $rg && $cpf && $data_nascimento && $sexo && $celular && $telefone && $fk_id_unidade && $fk_id_setor && $cep && $municipio && $uf && $logradouro && $numero && $complemento && $bairro) {
      $string_sql = mysqli_query($conn, "INSERT INTO pessoa_fisica (nome, rg, cpf, data_nascimento, sexo, celular, telefone, cd_unidade, cd_setor, cep, municipio, uf, logradouro, numero, complemento, bairro) 
        VALUES ('$nome', '$rg', '$cpf', '$data_nascimento', '$sexo', '$celular', '$telefone', '$fk_id_unidade', '$fk_id_setor', '$cep', '$municipio', '$uf', '$logradouro', '$numero', '$complemento', '$bairro')");
      if (!$string_sql) {
        echo "Erro ao cadastrar pessoa física: " . mysqli_error($conn);
      } else {
        echo "Pessoa física cadastrada com sucesso.";
      }
    }
  }

?>

<?php 
  $sql = "SELECT cd_unidade, nome FROM unidade";
  $result = $conn->query($sql);

  $sql2 = "SELECT cd_setor, nome FROM setor";
  $result2 = $conn->query($sql2);
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Pessoa Física</title>
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
        <!-- Botão de logoff -->
        <form class="d-flex" method="POST">
          <button class="btn btn-outline-light me-2" type="submit" name="logout">Logoff</button>
        </form>
      </div>
    </nav>
</div>

<br>

<b class="d-flex justify-content-center">Identificação</b><br>

<form method="post" action="pessoa_fisica.php">
<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-1">
        <label>Código:</label>
        <input type="text" class="form-control border border-dark" aria-label="Código" disabled=true id="codigo">
      </div>
      <div class="col-sm-3">
        <label>Nome Completo:</label>
        <input type="text" class="form-control border border-dark" aria-label="Nome Completo" id="nome", name="nome">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>RG:</label>
        <input type="text" class="form-control border border-dark" aria-label="Rg" maxlength="7" name="rg">
      </div>
      <div class="col-sm-2">
        <label>CPF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Cpf" maxlength="11" name="cpf">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Data Nascimento:</label>
        <input type="date" class="form-control border border-dark" aria-label="Nascimento" name="data_nascimento">
      </div>
      <div class="col-sm-2">
        <label>Sexo:</label>
        <select class="form-select border border-dark" id="floatingSelect" aria-label="Floating label select example" name="sexo">
        <option value="" disabled selected>Não informado</option>
        <option value="1">Masculino</option>
        <option value="2">Feminino</option>
        </select>
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Celular:</label>
        <input type="text" class="form-control border border-dark" aria-label="Celular" name="celular">
      </div>
      <div class="col-sm-2">
        <label>Telefone (opcional):</label>
        <input type="text" class="form-control border border-dark" aria-label="Telefone" name="telefone">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
        <div class="col-sm-2">
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
        <div class="col-sm-2">
          <select class="form-select border border-dark" name="setor">
            <option value="" disabled selected>Selecionar Setor Existente</option>
            <?php
              if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                  echo "<option value='" . $row['cd_setor'] . "'>" . $row['nome'] . "</option>";
                }
              }
            ?>
          </select>
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
        <input type="text" class="form-control border border-dark" aria-label="Município" id="municipio" name="municipio">
      </div>
      <div class="col-sm-1">
        <label>UF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Uf" id="uf" name="uf">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-3">
        <label>Logradouro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Logradouro" id="logradouro" name="logradouro">
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
    <button class="form-control btn btn btn-success" type="submit" value="submit" name="submit">Cadastrar</button>
  </div>
  <div class="col-sm-2">
    <br>
    <button type="button" class="form-control btn btn btn-danger">Deletar</button>
  </div>
</div>
</form>

  </body>
</html>