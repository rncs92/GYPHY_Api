<?php
require_once('main.php');
?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GIPHY World</title>
    <style>
        header {
            background: #c9f9f8;
            padding: 2em;
            text-align: center;
        }
    </style>
</head>

<body>

    <header>

        <h1>Welcome to GIPHY!</h1>

    </header>

    <form method="get" action="index.php">
        <label for="search">Search GIF</label><br>
        <input type="text" id="search" name="search"><br>
        <label for="amount">Amount</label><br>
        <input type="number" id="amount" name="amount"><br>
        <input type="submit" value="submit">
    </form>
    <?php if(!empty($gif)): ?>
        <ul>
            <?php
            foreach($gif as $filename) {
                echo "<ul><img src='{$filename->getUrl()}'></ul>";
            }
            ?>
        </ul>
    <?php else: ?>
        <p><strong>No GIFs found, please use the search!</strong></p>
    <?php endif; ?>
</body>
</html>
