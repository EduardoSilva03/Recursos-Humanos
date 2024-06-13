<?php
  include_once('./conn.php');
  if (isset($_POST['cd_pessoa'])) {
    $cd_pessoa = $_POST['cd_pessoa'];

    $sql = "SELECT * FROM controle_ponto WHERE cd_pessoa = '$cd_pessoa'";
    $result = $conn->query($sql);
    $schedules = array();

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $schedules[] = $row;
      }
    }

    echo json_encode($schedules);
  }
?>