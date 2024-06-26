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
    $fk_id_pessoa = isset($_POST['pessoa_fisica']) ? $_POST['pessoa_fisica'] : '';
    $hora_inicial = isset($_POST['hora_inicial']) ? $_POST['hora_inicial'] : '';
    $hora_final = isset($_POST['hora_final']) ? $_POST['hora_final'] : '';
    $data = isset($_POST['data']) ? $_POST['data'] : '';

    if ($fk_id_pessoa && $hora_inicial && $hora_final && $data) {
      $string_sql = mysqli_query($conn, "INSERT INTO controle_ponto (cd_pessoa, data, hora_inicial, hora_final) 
        VALUES ('$fk_id_pessoa', '$data', '$hora_inicial', '$hora_final')");
      if (!$string_sql) {
        echo "Erro ao cadastrar controle de ponto: " . mysqli_error($conn);
      }
    }
  }

  $sql = "SELECT pf.cd_pessoa, pf.nome, u.nome AS unidade FROM pessoa_fisica pf INNER JOIN unidade u ON pf.cd_unidade = u.cd_unidade";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
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
<body class="p-3 m-0 border-0 bd-example m-0 border-0">

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

<form method="post" action="controle_ponto.php">
<div class="row g-3 d-flex justify-content-center">
    <div class="col-sm-2">
        <select class="form-select border border-dark" name="pessoa_fisica" id="pessoa_fisica">
            <option value="" disabled selected>Selecionar Funcionário</option>
            <?php
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['cd_pessoa'] . "'>" . $row['cd_pessoa'] . " - " . $row['nome'] . " - " . $row['unidade'] . "</option>";
                }
              }
            ?>
        </select>
    </div>
</div>

<br>

<div id="calendar"></div>

<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Adicionar Horário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <input type="hidden" id="selectedDate" name="data">
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Horário Inicial</label>
                        <input type="time" class="form-control" id="hora_inicial" name="hora_inicial" required>
                    </div>
                    <div class="mb-3">
                        <label for="endTime" class="form-label">Horário Final</label>
                        <input type="time" class="form-control" id="hora_final" name="hora_final" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" value="submit" name="submit" class="btn btn-primary" id="saveEvent">Salvar</button>
            </div>
        </div>
    </div>
</div>
</form>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            locale: 'pt-br',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                var eventModal = new bootstrap.Modal(document.getElementById('eventModal'), {});
                eventModal.show();

                $('#selectedDate').val(moment(start).format('YYYY-MM-DD'));

                $('#saveEvent').off('click').on('click', function() {
                    var startTime = $('#hora_inicial').val();
                    var endTime = $('#hora_final').val();

                    if (startTime && endTime) {
                        var eventData = {
                            title: 'Evento',
                            start: moment(start).format('YYYY-MM-DD') + 'T' + startTime,
                            end: moment(start).format('YYYY-MM-DD') + 'T' + endTime
                        };

                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                        eventModal.hide();
                    }
                });

                $('#calendar').fullCalendar('unselect');
            },
            editable: true,
            eventLimit: true
        });

        function loadSchedules(cd_pessoa) {
            $.ajax({
                url: 'get_schedules.php',
                type: 'POST',
                data: { cd_pessoa: cd_pessoa },
                success: function(response) {
                    var schedules = JSON.parse(response);
                    $('#calendar').fullCalendar('removeEvents');
                    schedules.forEach(function(schedule) {
                        var eventData = {
                            title: 'Expediente',
                            start: schedule.data + 'T' + schedule.hora_inicial,
                            end: schedule.data + 'T' + schedule.hora_final
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
        }

        $('#pessoa_fisica').change(function() {
            var cd_pessoa = $(this).val();
            loadSchedules(cd_pessoa);
        });
    });
</script>

</body>
</html>