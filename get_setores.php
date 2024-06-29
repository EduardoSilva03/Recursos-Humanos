<?php
include_once('./conn.php');

if (isset($_POST['unidade'])) {
  $unidadeId = $_POST['unidade'];
  $sql = "SELECT cd_setor, nome FROM setor WHERE cd_unidade = $unidadeId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='" . $row['cd_setor'] . "'>" . $row['nome'] . "</option>";
    }
  } else {
    echo "<option value='' disabled selected>Nenhum setor encontrado</option>";
  }
}
?>