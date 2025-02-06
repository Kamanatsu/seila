<?php
    require_once "functions.php";
    volta_login();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="ademiro" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" value="1234" required>
            </div>
            <div class="form-group">
                <button class="btn-submit" type="submit">Entrar</button>
            </div>
            <div class="form-footer">
                <a href="#">Cadastrar</a>
            </div>
        </form>
    </div>
</body>
</html>

