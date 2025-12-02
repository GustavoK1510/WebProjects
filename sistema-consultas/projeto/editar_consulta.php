<?php
session_start();
require "conexao.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["user_id"];

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$consulta_id = $_GET['id'];

$sql = "SELECT * FROM consultas WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $consulta_id, $id);
$stmt->execute();
$consulta = $stmt->get_result()->fetch_assoc();

if (!$consulta) {
    echo "Consulta não encontrada.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_consulta = $_POST['data_consulta'];
    $hora_consulta = $_POST['hora_consulta'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE consultas SET data_consulta = ?, hora_consulta = ?, descricao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $data_consulta, $hora_consulta, $descricao, $consulta_id);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Erro ao atualizar a consulta.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consulta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <h2>Editar Consulta</h2>
        <div class="nav-actions">
            <a class="btn-blue" href="dashboard.php">Voltar</a>
        </div>
    </div>

    <div class="container">
        <h1>Edite sua consulta</h1>

        <form action="editar_consulta.php?id=<?= $consulta['id'] ?>" method="POST">
            <label for="data_consulta">Data:</label>
            <input type="date" name="data_consulta" id="data_consulta" value="<?= $consulta['data_consulta'] ?>" required>

            <label for="hora_consulta">Hora:</label>
            <input type="time" name="hora_consulta" id="hora_consulta" value="<?= $consulta['hora_consulta'] ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" rows="4" required><?= $consulta['descricao'] ?></textarea>

            <button type="submit" class="btn-blue">Salvar alterações</button>
        </form>
    </div>
</body>
</html>
