<?php
session_start();
include_once('./conn.php');

if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM login WHERE usuario = ? AND senha = md5(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
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
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/Recursos Humanos/js/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="/Recursos Humanos/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(img/fundoabs.jpg);
        }
        .container-custom {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            max-width: 400px;
        }
    </style>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">

<!-- Modal -->
<div class="modal fade" id="politicaPrivacidadeModal" tabindex="-1" aria-labelledby="politicaPrivacidadeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="politicaPrivacidadeModalLabel">Política de Privacidade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>1. Objetivo</strong></p>
        <p>A presente “Política de Privacidade” tem o condão de atender os princípios do livre acesso e da transparência, previstos no artigo 6º, incisos IV e VII, respectivamente, e artigo 9º, ambos da Lei nº 13.709, de 2018 (Lei Geral de Proteção de Dados), e garantir o acesso facilitado, disponibilizando de forma clara, adequada e ostensiva as informações sobre o tratamento de dados dos usuários, que estão sob a guarda do Projeto Sistema RH. Essa Política poderá ser alterada a qualquer momento por determinações legais, regulatórias ou determinações internas, sendo disponibilizada a nova versão em seu próprio sistema.</p>

        <p><strong>2. Definições legais</strong></p>
        <p>Para melhor compreensão da “Política de Privacidade”, elaboramos esse glossário com os principais termos utilizados com base no artigo 5º da Lei Geral de Proteção de Dados. Fique à vontade para revisitá-lo sempre que tiver dúvidas.</p>

        <p><strong>Agentes de tratamento:</strong> são aqueles responsáveis pelo Tratamento de Dados Pessoais. Estão separados em duas categorias: O controlador e o operador. O controlador é a pessoa física ou jurídica responsável pelas decisões referentes ao Tratamento de Dados Pessoais, no caso do tratamento de seus dados, Sistema RH.</p>

        <p><strong>Anonimização:</strong> é a técnica por meio da qual um dado perde a possibilidade de associação, direta ou indireta, a um indivíduo, de modo que posteriormente é impossível a reidentificação, utilizando os meios técnicos disponíveis (artigo 5º, inciso XI, da Lei Geral de Proteção de Dados).</p>

        <p><strong>Autoridade Nacional de Proteção de Dados (ANPD):</strong> é o órgão da administração pública federal com atribuições relacionadas à proteção de dados pessoais e da privacidade, incluindo a fiscalização para o cumprimento da LGPD.</p>

        <p><strong>Dados Pessoais:</strong> são conceituados na LGPD como as informações relacionadas a pessoa natural ou informações que permitem sua identificação como nome, endereço, CPF, RG, documentos de identidade em geral, telefone, dentre outros.</p>

        <p><strong>Dados Pessoais Sensíveis:</strong> são conceituados na LGPD como os Dados Pessoais sobre origem racial ou étnica, convicção religiosa, opinião política, filiação a sindicato ou organização de caráter religioso, filosófico ou político, dado referente à saúde ou à vida sexual, dado genético ou biométrico, quando vinculado a uma pessoa natural.</p>

        <p><strong>Política de Privacidade:</strong> é o documento previsto no artigo 9º da LGPD, que deve ser disponibilizado aos titulares de dados contendo as informações sobre o tratamento de seus dados, incluindo, mas não se limitando à finalidade específica do tratamento, a forma e duração do tratamento, a identificação do controlador, as informações de contato do controlador, as informações acerca do uso compartilhado de dados, as responsabilidades dos agentes de tratamento e os direitos do titular.</p>

        <p><strong>Titular de Dados:</strong> qualquer pessoa física identificada ou identificável a quem se referem os dados pessoais tratados. São, por exemplo, nossos clientes, potenciais clientes, colaboradores, terceiros, prestadores de serviço, candidatos a vagas, dentre outros.</p>

        <p><strong>Tratamento de Dados:</strong> qualquer operação realizada com os Dados Pessoais de forma automatizada ou não. É a coleta, produção, recepção, classificação, utilização, acesso, reprodução, transmissão, distribuição, processamento, armazenamento, arquivamento, eliminação, avaliação ou controle da informação, modificação, comunicação, transferência, difusão ou extração.</p>

        <p><strong>3. Como tratamos seus dados</strong></p>
        <p>Na medida do permitido pela lei aplicável, considerando as categorias e tipos de dados pessoais coletados, observados os princípios da finalidade, adequação, necessidade, livre acesso, qualidade dos dados, transparência, segurança, prevenção, não discriminação e responsabilização e prevenção de contas, o Sistema RH tem acesso a:</p>
        
        <ul>
          <li>Dados de identificação pessoal: nome, sobrenome, CPF, RG, data de nascimento, sexo, celular, endereço;</li>
          <li>Dados profissionais: nome da empresa e setor, hora inicial e hora final de trabalho.</li>
        </ul>

        <p>Para toda a coleta de dados pessoais, o Sistema RH seguirá as seguintes determinações, de acordo com o artigo 6º da LGPD:</p>
        
        <ul>
          <li>Caso seja necessário coletar mais dados do que os aqui informados, será avisado, acompanhado da justificativa contendo a finalidade devida;</li>
          <li>Os Dados Pessoais coletados somente serão utilizados para as finalidades declaradas a você.</li>
        </ul>

        <p><strong>4. Finalidades específicas de tratamento de dados</strong></p>
        <p>Os dados coletados, nos termos da presente “Política de Privacidade”, são utilizados para as seguintes finalidades:</p>

        <ul>
          <li>Autenticação;</li>
          <li>Cadastro de pessoa física;</li>
          <li>Cadastro de empresa;</li>
          <li>Cadastro de setor;</li>
          <li>Controle de ponto no trabalho.</li>
        </ul>

        <p><strong>5. Como protegemos os seus dados</strong></p>
        <p>Os seus dados são protegidos usando rígidos padrões de segurança da informação e confidencialidade, mediante tecnologias com acessos restritos, criptografias e demais medidas preventivas e contínuas para evitar acessos não autorizados e vazamentos de dados pessoais. Havendo perda, roubo, tentativa de acesso indevido ou não autorizado de seus documentos pessoais ou produtos e serviços contratados, o usuário deverá comunicar ao Sistema RH o mais rápido possível.</p>

        <p><strong>6. Conheça seus direitos</strong></p>

        <p>Direito de confirmação da existência de tratamento: Você tem o direito de confirmar se o Sistema RH trata os seus dados pessoais, ou não;</p>
        
        <p>Direito de correção e atualização: Você tem o direito de solicitar ao Sistema RH qualquer correção de suas informações e/ou preenchimento de informações que você acredite estarem incompletas, equivocadas ou desatualizadas;</p>
        
        <p>Direito de exclusão, bloqueio, portabilidade e anonimização: Você tem o direito de solicitar que o Sistema RH exclua, anonimize ou bloqueie seus dados pessoais, conforme estabelecido em lei. Note que existem certas condições que podem impedir essa solicitação;</p>
        
        <p>Direito de consulta em caso de não consentir o tratamento e suas consequências: Você poderá consultar sobre a possibilidade de não consentir o uso de seus dados para tratamento pelo Sistema RH e quais as consequências dessa ação para você.</p>

        <p><strong>7. Responsabilidade</strong></p>
        <p>O Sistema RH é responsável e se compromete a garantir a segurança de seus dados. Caso algum incidente de segurança venha a ocorrer, serão envidados todos os esforços para que o dano seja minimizado e/ou mitigado, os titulares e a ANPD serão avisados imediatamente, bem como as posteriores medidas adotadas e sua efetiva resolução.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Seu formulário com o link para abrir o modal -->
<div class="container-fluid container-custom">
    <form class="form-container" action="login.php" method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">USUÁRIO</label>
            <input type="text" class="form-control" id="usuario" name="usuario">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">SENHA</label>
            <input type="password" class="form-control" id="senha" name="senha">
            <a href="#" data-toggle="modal" data-target="#politicaPrivacidadeModal">Política de Privacidade</a>
        </div>
        <button type="submit" value="submit" name="submit" class="btn btn-primary">Acessar</button>
    </form>
</div>

  </body>
</html>