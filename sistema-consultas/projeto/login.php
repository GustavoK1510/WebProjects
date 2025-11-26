<?php
    session_start();
    require "conexao.php";

    $msg = "";

    if (isset($_GET["cadastrado"])) {
        $msg = "Conta criada com sucesso! Faça login.";
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST["email"]);
        $senha = trim($_POST["senha"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "E-mail inválido!";
        } else {
            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($senha, $user["senha"])) {
                $_SESSION["user_id"] = $user["id"];
                header("Location: dashboard.php");
                exit;
            } else {
                $msg = "E-mail ou senha incorretos!";
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
    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Seu e-mail" required>
        <input type="password" name="senha" placeholder="Sua senha" required>

        <button type="submit">Entrar</button>
    </form>

    <?php if ($msg): ?>
        <p style="color:red; margin-top:10px;"><?= $msg ?></p>
    <?php endif; ?>

    <a href="cadastro.php">Criar uma conta</a>
</div>

</body>
</html>
