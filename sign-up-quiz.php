<?php
include 'component.php'; // banner code
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Coding made easy';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

$currentFile = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | About You</title>
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
    generateBanner($backLinkURL,$bannerText,false, false, false);
    ?>
</header>
<main class="page-wrapper sign-up-quiz-wrapper">
    <h1 class="main-heading">About You</h1>

    <form  action="./crud/start-pages.php" method="post">
        <section class="text-input-section">
            <input  class="text-input" id="child-name"  name="child-name" placeholder="Child Name" required>
            <label class="hidden-label" for="child-name"></label>

            <input  class="text-input " id="age-input" name="age" placeholder="Age" maxlength="2" type="number" required>
            <label class="hidden-label" for="age-input"></label>

<!-- hidden values-->
            <input type="hidden" name="sign-up-email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            <input type="hidden" name="sign-up-password" value="<?php echo isset($password) ? htmlspecialchars($password) : ''; ?>">

            <input type="hidden" name="current_file" value="<?php echo htmlspecialchars($currentFile); ?>">

        </section>

        <section class="skill-quiz">
            <div class="sign-up-quiz-stack">
                <h2 class="sub-heading">Do you have any experience with HTML?</h2>
                <div class="radio-btn-stack">
                    <input type="radio" onclick="update('html-skill') " name="html-skill" id="html-option-1"><label class="radio-label" for="html-option-1">I have no HTML experience.</label>
                    <input type="radio" onclick="update('html-skill')" name="html-skill" id="html-option-2"><label class="radio-label" for="html-option-2">I have a bit of experience, but I'm not too confident.</label>
                    <input type="radio" onclick="update('html-skill')" name="html-skill" id="html-option-3"><label class="radio-label" for="html-option-3">I am confident I know the basics.</label>
                    <input type="radio" onclick="update('html-skill') " name="html-skill" id="html-option-4"><label class="radio-label" for="html-option-4">I know most things; I’d just like to revise.</label>
                </div>
            </div>

            <div class="sign-up-quiz-stack">
                <h2  class="sub-heading">Do you have any experience with CSS?</h2>
                <div class="radio-btn-stack">
                    <input type="radio" onclick="update(this.name)" name="css-skill"  id="css-option-1"><label class="radio-label" for="css-option-1">I have no CSS experience.</label>
                    <input type="radio" onclick="update('css-skill')" name="css-skill"  id="css-option-2"><label class="radio-label" for="css-option-2">I have a bit of experience, but I'm not too confident.</label>
                    <input type="radio" onclick="update('css-skill')" name="css-skill"  id="css-option-3"><label class="radio-label" for="css-option-3">I am confident I know the basics.</label>
                    <input type="radio" onclick="update('css-skill')" name="css-skill" id="css-option-4"><label class="radio-label" for="css-option-4">I know most things; I’d just like to revise.</label>
                </div>
            </div>
        </section>

        <div class="notification-box" id="notification-box" >
            <p class="notification-box-text" id="html-recommendation"></p>
            <p class="notification-box-text" id="css-recommendation"></p>
        </div>

        <button type="submit" class=" btn-green next-btn">Next</button>
    </form>

</main>

<script src="./js/sign-up-quiz.js"></script>
</body>
</html>
