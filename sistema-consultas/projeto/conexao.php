<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "consultas_db";

    $conn = new mysqli($host, $user, $pass, $db, 3307);

    if ($conn->connect_error) {
        die("Erro: " . $conn->connect_error);
    }
?>