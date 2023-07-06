<?php
include 'component.php'; // banner code
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Coding made easy';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Sign Up</title>
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
    generateBanner($backLinkURL,$bannerText,false, false,false);
    ?>
</header>
<main class=" sign-up-wrapper ">
    <h1 class="main-heading ">Sign up</h1>

    <form action="sign-up-quiz.php" method="post">
        <input class="text-input" id="sign-up-email" type="email" name="email" placeholder="E-mail Address" required>
        <label class="hidden-label" for="sign-up-email">E-mail Address</label>

        <input class="text-input" id="sign-up-password" type="password" name="password" placeholder="Password" required>
        <label class="hidden-label" for="sign-up-password">Password</label>

        <button type="submit" class="btn btn-green" >Sign up</button>
        <div class="fine-print-box">
            <a class="fine-print" href="log-in.php">Don’t have an account?<br>Log in here!</a>
        </div>
    </form>

</main>
<?php
//Place at the bottom of page so Page loads before sending alert
if (isset($_GET['value'])) {
    $decodedValue = urldecode($_GET['value']);
    if ($decodedValue = "400:Account-exists") {
        echo '<script>window.addEventListener("load", function() { alert("An account using this e-mail already exists.\nPlease use a different e-mail or login"); });</script>';
    }
}
?>
</body>
</html>



