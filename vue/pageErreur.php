<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../dist/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <h1>Dashboard</h1>
        <div>
            <form action="../index.php" method="post">
                <input type="submit" value='<?php echo $valueDeco; ?>' name="deco">
            </form>
        </div>
    </nav>

    <main>
        <h2><?php echo $title; ?></h2>
    </main>
</body>
</html>