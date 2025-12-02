<?php
    require "conexao.php";

    $msg = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = trim($_POST["nome"]);
        $email = trim($_POST["email"]);
        $senha = trim($_POST["senha"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "E-mail inválido!";
        } elseif (strlen($senha) < 6) {
            $msg = "A senha deve ter pelo menos 6 caracteres!";
        } else {
            $verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
            $verifica->bind_param("s", $email);
            $verifica->execute();
            $result = $verifica->get_result();

            if ($result->num_rows > 0) {
                $msg = "Este e-mail já está cadastrado!";
            } else {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $nome, $email, $senhaHash);

                if ($stmt->execute()) {
                    header("Location: login.php?cadastrado=1");
                    exit;
                } else {
                    $msg = "Erro ao cadastrar!";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Criar Conta</h2>

        <form method="POST">
            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="Seu e-mail" required>
            <input type="password" name="senha" placeholder="Senha (mínimo 6 caracteres)" required>

            <button type="submit">Cadastrar</button>
        </form>

        <?php if ($msg): ?>
            <p style="color:red; margin-top:10px;"><?= $msg ?></p>
        <?php endif; ?>

        <a href="login.php">Já possui conta? Fazer login</a>
    </div>
</body>
</html>
