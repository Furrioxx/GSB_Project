<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
</head>
<body>
    <nav>
        <?php include('../vue/UserNav.php') ?>
    </nav>

    <span>
        <h2><?php echo $title; ?></h2>
        <p class="mb-3">Admin</p>

        <form action="../controller/addUser.php" method="post" enctype="multipart/form-data">

        </form>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>