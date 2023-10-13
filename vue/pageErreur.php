<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
</head>
<body>
    <nav>
        <h1>Dashboard</h1>
        <div>
            <form action="../index.php" method="post">
                <input type="submit" value='<?php echo $valueDeco; ?>' name="deco" class="big-btn">
            </form>
        </div>
    </nav>

    <main>
        <h2><?php echo $title; ?></h2>
    </main>
</body>
</html>