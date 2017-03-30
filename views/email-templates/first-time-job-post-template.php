<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<header>A new job posted</header>
<title><?php echo htmlentities($title, ENT_COMPAT, 'UTF-8') ?></title>
<div><?php echo htmlentities($description, ENT_COMPAT, 'UTF-8') ?></div>
<nav>
    <a href="<?php echo $publishUrl ?>">Publish</a> |
    <a href="<?php echo $spamUrl ?>">Spam</a>
</nav>
</body>
</html>