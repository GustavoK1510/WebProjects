<?php
session_start();
require "conexao.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["user_id"];

$sql = "SELECT * FROM consultas WHERE usuario_id = ? ORDER BY data_consulta, hora_consulta";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$consultas = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <h2>Minhas Consultas</h2>
        <div class="nav-actions">
            <a class="btn-blue" href="marcar_consulta.php">+ Nova Consulta</a>
            <a class="btn-red" href="logout.php">Sair</a>
        </div>
    </div>

    <div class="container">
        <h1>Próximas Consultas</h1>

        <a class="delete-account" href="deletar_conta.php">Excluir Conta</a>

        <div class="consultas-wrapper">
            <?php if ($consultas->num_rows == 0): ?>
                <p class="empty">Nenhuma consulta marcada.</p>
            <?php else: ?>
                <?php while ($c = $consultas->fetch_assoc()): ?>
                    <div class="consulta-card">
                        <div class="info">
                            <p><strong>Data:</strong> <?= $c["data_consulta"] ?></p>
                            <p><strong>Hora:</strong> <?= $c["hora_consulta"] ?></p>
                            <p><strong>Descrição:</strong> <?= $c["descricao"] ?></p>
                        </div>

                        <div class="actions">
                            <a class="btn-edit" href="editar_consulta.php?id=<?= $c["id"] ?>">Editar</a>
                            <a class="btn-delete" href="deletar_consulta.php?id=<?= $c["id"] ?>">Excluir</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>
