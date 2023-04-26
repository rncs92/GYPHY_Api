<?php
namespace Giphy\View;
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
            background-image: url(../../jon-moore-5fIoyoKlz7A-unsplash.jpg);
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

    <h1>Trending GIFs</h1>

</header>

    <ul>
        <?php if(!empty($trending)): ?>
            <?php
            foreach($trending as $filename) {
                echo "<img src='{$filename->getUrl()}'>" . ' ';
            }
            ?>
        <?php else: ?>
            <?php echo 'Something went wrong!'; ?>
        <?php endif; ?>
    </ul>

</body>
</html>
