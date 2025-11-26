<?php
    session_start();
    require "conexao.php";

    $id = $_SESSION["user_id"];

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    session_destroy();

    header("Location: login.php");
    exit;
?>