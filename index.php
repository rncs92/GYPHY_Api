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
            padding: 2em;
            text-align: center;
        }
        body {
            background-image: url(jon-moore-5fIoyoKlz7A-unsplash.jpg);
        }
        h2 {
            text-align: center;
        }
        form {
            text-align: center;
        }
    </style>
</head>

<body>

    <header>

        <h1>GIPHY!</h1>

    </header>

    <form method="get" action="index.php">
        <label for="search"><strong>Search GIF</strong></label><br>
        <input type="text" id="search" name="search" placeholder="Search"><br>
        <label for="amount"><strong>Amount</strong></label><br>
        <input type="number" id="amount" name="amount" placeholder="Amount"><br>
        <input type="submit" value="submit">
    </form>
    <?php if(!empty($gif)): ?>
        <ul>
            <?php
            foreach($gif as $filename) {
                echo "<img src='{$filename->getUrl()}'>";
            }
            ?>
        </ul>
    <?php else: ?>
            <h2>Trending GIFs</h2>
            <?php if(!empty($trending)): ?>
            <?php
            foreach($trending as $filename) {
                echo "<img src='{$filename->getUrl()}'>" . ' ';
            }
            ?>
            <?php else: ?>
            <?php echo 'Something went wrong!'; ?>
            <?php endif; ?>
    <?php endif; ?>
</body>
</html>
