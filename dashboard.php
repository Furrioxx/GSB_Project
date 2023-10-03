<?php
session_start();

$valueDeco = "";

if(isset($_SESSION['mail'])){
    if(isset($_SESSION['error_msg'])){
        unset($_SESSION['error_msg']);
    }

    $valueDeco = 'Déconnexion';

    $title = "Bonjour " .   $_SESSION['mail'];

}
else{
    $title = "Veuillez vous connecter pour accéder à votre dashboard";
    $valueDeco = 'Se connecter';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <h1><?php echo $title; ?></h1>
        <form action="index.php" method="post">
            <input type="submit" value='<?php echo $valueDeco; ?>' name="deco">
        </form>
    </nav>
</body>
</html>