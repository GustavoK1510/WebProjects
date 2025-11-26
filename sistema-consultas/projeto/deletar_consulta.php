<?php
    session_start();
    require "conexao.php";

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "DELETE FROM consultas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
?>
