<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doggo</title>
    <link rel="stylesheet" href="css/style.css">
    <?php echo $sLinktoExtraCss ?? ''; ?>
    <?php session_start();?>
    <script>
        window.myCustomData = "<?php echo $_SESSION['sEmail'] ?>"
    </script>
</head>
<body <?= $sGreyBodyClass ?? "" ?> >
    <nav class="shadow">
        <div class="left-nav">
            <a href="login"><img class="logo" src="images/doggo-loggo.svg"></a>
            <a href="search"><img src="images/search.svg" class="small-icon">Search for dog sitters</a>
            <a href="become"><img src="images/dog.svg" class="small-icon">Become a dog sitter</a>
        </div>
        <div class="right-nav">
            <a href="login">Log in</a>
            <a href="signup">Sign up</a>
        </div>
    </nav>