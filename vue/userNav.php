<img src="../src/logo.png" alt="logo gsb" width="130px">
<h1>Dashboard</h1>
<div>
    <img src="../src/user.jpg" alt="user image" class="user-image">
    <svg xmlns="http://www.w3.org/2000/svg" id="menuBtn" class="icon icon-tabler icon-tabler-menu-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M4 6l16 0"></path>
        <path d="M4 12l16 0"></path>
        <path d="M4 18l16 0"></path>
    </svg>
    <div class="navUser">
        <p><?php echo $_SESSION['name'] . " " . $_SESSION['surname']?></p>
        
        <form action="../index.php" method="get">
            <input type="submit" name="deco" value="Déconnexion" class="deo-btn">
        </form>
    </div>
</div>
