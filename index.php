<?php
session_start();


// destrcution de la session après déconnexion
if(isset($_POST['deco'])){
    session_destroy();
    $hrefLogIn = "connexion.php";
}
else{
    if(isset($_SESSION['mail'])){
        $hrefLogIn = "dashboard.php";
    }
    else{
        $hrefLogIn = "connexion.php";
    }
}
?>

<!-- formulaire de connexion -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de frais GSB</title>
    <link rel="stylesheet" href="dist/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <h1>Bienvenue</h1>
        <div>
            <a href="<?php echo $hrefLogIn; ?>"><button>Connexion</button></a>
        </div>
    </nav>

    <div class="flexContainer">
        <p class="titleIndex">Fiche de frais GSB</p>
    </div>
    
    <img src="src/cloud.png" alt="cloud background" class="cloud">
    <img src="src/cloud.png" alt="cloud background" class="cloud1">
</body>
</html>