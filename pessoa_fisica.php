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

  $pessoa_fisica = null;
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT pf.cd_pessoa, pf.nome, pf.rg, pf.cpf, pf.data_nascimento, pf.sexo, pf.celular, pf.telefone, pf.cd_unidade, pf.cd_setor, pf.cep, pf.municipio, pf.uf, pf.logradouro, pf.numero, pf.complemento, pf.bairro, u.nome AS nomeUnidade, s.nome AS nomeSetor FROM pessoa_fisica pf INNER JOIN unidade u ON pf.cd_unidade = u.cd_unidade INNER JOIN setor s ON pf.cd_setor = s.cd_setor WHERE pf.cd_pessoa = $id");
    if ($result->num_rows > 0) {
      $pessoa_fisica = $result->fetch_assoc();
    }
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
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if (!empty($id)) {
      $sql = "UPDATE pessoa_fisica SET nome = '$nome', rg = '$rg', cpf = '$cpf', data_nascimento = '$data_nascimento', sexo = '$sexo', celular = '$celular', telefone = '$telefone', cd_unidade = '$fk_id_unidade', cd_setor = '$fk_id_setor', cep = '$cep', municipio = '$municipio', uf = '$uf', logradouro = '$logradouro', numero = '$numero', complemento = '$complemento', bairro = '$bairro' WHERE cd_pessoa = $id";
    } else {
      $sql = "INSERT INTO pessoa_fisica (nome, rg, cpf, data_nascimento, sexo, celular, telefone, cd_unidade, cd_setor, cep, municipio, uf, logradouro, numero, complemento, bairro) VALUES ('$nome', '$rg', '$cpf', '$data_nascimento', '$sexo', '$celular', '$telefone', '$fk_id_unidade', '$fk_id_setor', '$cep', '$municipio', '$uf', '$logradouro', '$numero', '$complemento', '$bairro')";
    }
  
    if ($conn->query($sql) === TRUE) {
      header("Location: consulta_pessoa_fisica.php");
      exit();
    } else {
      echo "Erro: " . $conn->error;
    }
  }

  if (isset($_POST['delete'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
  
    if (!empty($id)) {
      $sql = "DELETE FROM pessoa_fisica WHERE cd_pessoa = $id";
  
      if ($conn->query($sql) === TRUE) {
        header("Location: consulta_pessoa_fisica.php");
        exit();
      } else {
        echo "Erro: " . $conn->error;
      }
    
    }
  }

?>

<?php 
  $sql = "SELECT cd_unidade, nome FROM unidade";
  $result = $conn->query($sql);

  $sql2 = "SELECT s.cd_setor, s.nome FROM setor s INNER JOIN unidade u ON s.cd_unidade = u.cd_unidade WHERE 1=1";
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

<b class="d-flex justify-content-center">Identificação</b><br>

<form method="post" action="pessoa_fisica.php">
<input type="hidden" name="id" value="<?php echo $pessoa_fisica ? $pessoa_fisica['cd_pessoa'] : ''; ?>">
<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-4">
        <label>Nome Completo:</label>
        <input type="text" class="form-control border border-dark" aria-label="Nome Completo" id="nome", name="nome" value="<?php echo $pessoa_fisica ? $pessoa_fisica['nome'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>RG:</label>
        <input type="text" class="form-control border border-dark" aria-label="Rg" maxlength="7" name="rg" value="<?php echo $pessoa_fisica ? $pessoa_fisica['rg'] : ''; ?>">
      </div>
      <div class="col-sm-2">
        <label>CPF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Cpf" maxlength="11" name="cpf" value="<?php echo $pessoa_fisica ? $pessoa_fisica['cpf'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Data Nascimento:</label>
        <input type="date" class="form-control border border-dark" aria-label="Nascimento" name="data_nascimento" value="<?php echo $pessoa_fisica ? $pessoa_fisica['data_nascimento'] : ''; ?>">
      </div>
      <div class="col-sm-2">
        <label>Sexo:</label>
        <select class="form-select border border-dark" id="floatingSelect" aria-label="Floating label select example" name="sexo">
            <option value="" disabled>Não informado</option>
            <option value="1" <?php echo ($pessoa_fisica && $pessoa_fisica['sexo'] == '1') ? 'selected' : ''; ?>>Masculino</option>
            <option value="2" <?php echo ($pessoa_fisica && $pessoa_fisica['sexo'] == '2') ? 'selected' : ''; ?>>Feminino</option>
        </select>
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Celular:</label>
        <input type="text" class="form-control border border-dark" aria-label="Celular" name="celular" value="<?php echo $pessoa_fisica ? $pessoa_fisica['celular'] : ''; ?>">
      </div>
      <div class="col-sm-2">
        <label>Telefone (opcional):</label>
        <input type="text" class="form-control border border-dark" aria-label="Telefone" name="telefone" value="<?php echo $pessoa_fisica ? $pessoa_fisica['telefone'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
<div class="col-sm-2">
<select class="form-select border border-dark" name="unidade" id="unidade">
    <option value="" disabled>Selecionar Unidade Existente</option>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['cd_unidade'] . "'" . (($pessoa_fisica && $pessoa_fisica['cd_unidade'] == $row['cd_unidade']) ? ' selected' : '') . ">" . $row['nome'] . "</option>";
        }
    }
    ?>
</select>
</div>
<div class="col-sm-2">
<select class="form-select border border-dark" name="setor" id="setor">
    <option value="" disabled>Selecionar Setor Existente</option>
    <!-- Os setores serão carregados pelo JavaScript -->
</select>
</div>
</div>

<br>

<b class="d-flex justify-content-center">Endereço</b><br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-1">
        <label>CEP:</label>
        <input type="text" class="form-control border border-dark" aria-label="Cep" id="cep" name="cep" value="<?php echo $pessoa_fisica ? $pessoa_fisica['cep'] : ''; ?>">
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
        <input type="text" class="form-control border border-dark" aria-label="Município" id="municipio" name="municipio" value="<?php echo $pessoa_fisica ? $pessoa_fisica['municipio'] : ''; ?>">
      </div>
      <div class="col-sm-1">
        <label>UF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Uf" id="uf" name="uf" value="<?php echo $pessoa_fisica ? $pessoa_fisica['uf'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-3">
        <label>Logradouro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Logradouro" id="logradouro" name="logradouro" value="<?php echo $pessoa_fisica ? $pessoa_fisica['logradouro'] : ''; ?>">
      </div>
      <div class="col-sm-1">
        <label>Número:</label>
        <input type="text" class="form-control border border-dark" aria-label="Número" name="numero" value="<?php echo $pessoa_fisica ? $pessoa_fisica['numero'] : ''; ?>">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Complemento:</label>
        <input type="text" class="form-control border border-dark" aria-label="Complemento" name="complemento" value="<?php echo $pessoa_fisica ? $pessoa_fisica['complemento'] : ''; ?>">
      </div>
      <div class="col-sm-2">
        <label>Bairro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Bairro" id="bairro" name="bairro" value="<?php echo $pessoa_fisica ? $pessoa_fisica['bairro'] : ''; ?>">
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

<script>
  document.getElementById('unidade').addEventListener('change', function() {
    var unidadeId = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'get_setores.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (this.status == 200) {
        document.getElementById('setor').innerHTML = this.responseText;
        // Seleciona o setor correspondente
        var setorId = '<?php echo $pessoa_fisica ? $pessoa_fisica['cd_setor'] : ''; ?>';
        if (setorId) {
          document.getElementById('setor').value = setorId;
        }
      }
    };
    xhr.send('unidade=' + unidadeId);
  });

  // Carrega os setores na inicialização se uma unidade estiver selecionada
  window.onload = function() {
    var unidadeId = document.getElementById('unidade').value;
    if (unidadeId) {
      var event = new Event('change');
      document.getElementById('unidade').dispatchEvent(event);
    }
  };
</script>

  </body>
</html>