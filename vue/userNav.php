<img src="../src/logo.png" alt="logo gsb" width="130px">
<h1>Dashboard</h1>
<div>
    <?php
        $request = new request;
        $user = $request->isTherePp($db);
        foreach ($user as $key => $value) {
            if($value['ppLink'] != ''){
                echo '<img src="'.$value['ppLink'].'" alt="user image" class="user-image-perso">';
            }
            else{
                echo '<img src="../src/user.jpg" alt="user image" class="user-image">';
            }
        }
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" id="menuBtn" class="icon icon-tabler icon-tabler-menu-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M4 6l16 0"></path>
        <path d="M4 12l16 0"></path>
        <path d="M4 18l16 0"></path>
    </svg>
    <div class="navUser">
    <nav class="navbar navbar-expand-lg navbar-light navCo">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <a class="navbar-brand" href="#"><p style="color: white;"><?php echo $_SESSION['name'] . " " . $_SESSION['surname']?></p></a>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#"> <form action="../index.php" method="post">
            <input type="submit" name="deco" value="Déconnexion" class="deo-btn"  style="color: white;">
        </form></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile.php"  style="color: white;">Profil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </div>
</div>