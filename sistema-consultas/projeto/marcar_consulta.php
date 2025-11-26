<?php
    session_start();
    require "conexao.php";

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    $msg = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = $_POST["data"];
        $hora = $_POST["hora"];
        $desc = trim($_POST["descricao"]);
        $usuario_id = $_SESSION["user_id"];

        if (!$data || !$hora || !$desc) {
            $msg = "Preencha todos os campos!";
        } else {
            $sql = "INSERT INTO consultas (usuario_id, data_consulta, hora_consulta, descricao) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $usuario_id, $data, $hora, $desc);

            if ($stmt->execute()) {
                header("Location: dashboard.php");
                exit;
            } else {
                $msg = "Erro ao marcar consulta!";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">

    <h2>Marcar Consulta</h2>

    <form method="POST">
        <input type="date" name="data" required>
        <input type="time" name="hora" required>
        <input type="text" name="descricao" placeholder="Descrição da consulta" required>

        <button type="submit">Salvar</button>
    </form>

    <?php if ($msg): ?>
        <p style="color:red;"><?= $msg ?></p>
    <?php endif; ?>

    <a href="dashboard.php">Voltar</a>

</div>
</body>
</html>
