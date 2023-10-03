<?php
session_start();


if(isset($_SESSION['error_msg'])){
    echo $_SESSION['error_msg'];
}

if(isset($_POST['deco'])){
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form action="login.php" method="post">
        <input type="mail" placeholder="Mail" name="mail">
        <input type="password" placeholder="Password" name="password">
        <input type="submit" value="Login" name="submit">
    </form>
</body>
</html>