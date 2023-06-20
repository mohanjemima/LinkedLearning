<?php
include 'component.php'; // banner code
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Coding made easy';
$showBackLink = false;
$showHomeLink = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/start-pages.css">
</head>
<body>
<header>
<?=
// Generate the banner HTML code
generateBanner($backLinkURL,$bannerText,$showBackLink, $showHomeLink);
?>
</header>
<main class=" log-in-wrapper">
    <h1 class="main-heading">Log In</h1>

    <form action="./dashboard.php" method="post">
        <input class="text-input" id="login-email" type="email" name="email" placeholder="E-mail Address" required>
        <label class="hidden-label" for="login-email">E-mail Address</label>

        <input class="text-input" id="login-password" type="password" name="password" placeholder="Password" required>
        <label class="hidden-label" for="login-password">Password</label>

        <button class="btn btn-yellow" type="submit">Log In</button>
        <div class="fine-print-box">
            <a class="fine-print" href="sign-up.php">Don’t have an account?<br>Sign up here!</a>
        </div>
    </form>

</main>

</body>
</html>
