<?php
include_once('./conn.php');

if (isset($_POST['unidade'])) {
    $unidadeId = $_POST['unidade'];
    $sql = "SELECT cd_setor, nome FROM setor WHERE cd_unidade = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $unidadeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['cd_setor'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
    } else {
        echo "<option value='' disabled selected>Nenhum setor encontrado</option>";
    }
}
?>