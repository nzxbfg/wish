<?php session_start();
if(empty($_SESSION["login"])) :
else: header('Location: panel.php');
endif ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админку</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="body-login">
<main class="main-login">
    <form action="functions/login.php" method="POST">
    <div class="form-group">
        <input name="login" type="text" placeholder="LOGIN" id="login" required autofocus>
        <input name="pass" type="password" placeholder="PASS" required>
    </div>
        <button type="submit" class="manually-button">LOG-IN</button>
    </form>
</main>
</body>
</html>