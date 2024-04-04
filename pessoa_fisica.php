<?php

  include_once('conn.php');

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
      </div>
    </nav>
</div>

<br>

<b class="d-flex justify-content-center">Identificação</b><br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-1">
        <label>Código:</label>
        <input type="text" class="form-control border border-dark" aria-label="Código" disabled=true>
      </div>
      <div class="col-sm-3">
        <label>Nome Completo:</label>
        <input type="text" class="form-control border border-dark" aria-label="Nome Completo">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>RG:</label>
        <input type="text" class="form-control border border-dark" aria-label="Rg" maxlength="7">
      </div>
      <div class="col-sm-2">
        <label>CPF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Cpf" maxlength="11">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Data Nascimento:</label>
        <input type="date" class="form-control border border-dark" aria-label="Nascimento">
      </div>
      <div class="col-sm-2">
        <label>Sexo:</label>
        <select class="form-select border border-dark" id="floatingSelect" aria-label="Floating label select example">
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
        <input type="text" class="form-control border border-dark" aria-label="Celular">
      </div>
      <div class="col-sm-2">
        <label>Telefone (opcional):</label>
        <input type="text" class="form-control border border-dark" aria-label="Telefone">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Unidade:</label>
        <input type="text" class="form-control border border-dark" aria-label="Unidade">
      </div>
      <div class="col-sm-2">
        <label>Setor:</label>
        <input type="text" class="form-control border border-dark" aria-label="Setor">
      </div>
</div>

<br>

<b class="d-flex justify-content-center">Endereço</b><br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-1">
        <label>CEP:</label>
        <input type="text" class="form-control border border-dark" aria-label="Cep" id="cep">
      </div>
      <div class="col-sm-1">
        <br>
        <button class="form-control btn btn-outline-secondary" onclick="consultaCep()">Buscar</button>
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-3">
        <label>Município:</label>
        <input type="text" class="form-control border border-dark" aria-label="Município" id="municipio">
      </div>
      <div class="col-sm-1">
        <label>UF:</label>
        <input type="text" class="form-control border border-dark" aria-label="Uf" id="uf">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-3">
        <label>Logradouro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Logradouro" id="logradouro">
      </div>
      <div class="col-sm-1">
        <label>Número:</label>
        <input type="text" class="form-control border border-dark" aria-label="Número">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
      <div class="col-sm-2">
        <label>Complemento:</label>
        <input type="text" class="form-control border border-dark" aria-label="Complemento">
      </div>
      <div class="col-sm-2">
        <label>Bairro:</label>
        <input type="text" class="form-control border border-dark" aria-label="Bairro" id="bairro">
      </div>
</div>

<br>

<div class="row g-3 d-flex justify-content-center">
  <div class="col-sm-2">
    <br>
    <button class="form-control btn btn btn-success">Cadastrar</button>
  </div>
  <div class="col-sm-2">
    <br>
    <button class="form-control btn btn btn-danger">Deletar</button>
  </div>
</div>

  </body>
</html>