<?php

$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "recursoshumanos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Configurar charset para UTF-8
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para verificar login
function verificarSessao() {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }
}

// Função para logout
function realizarLogout() {
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>