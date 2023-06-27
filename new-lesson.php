<?php
include 'component.php'; // banner code
include './assets/data/sample-data.php'; // sample data

// Customize the link URLs, text, and display status for Banner
$backLinkURL = './staff-dashboard.php';// back link for the back button
$bannerText = 'Dashboard';
$showBackLink = true;
$showHomeLink = false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | New Lesson</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/lesson-content.css">
</head>
<body>
<header>
    <?=
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText,$showBackLink, $showHomeLink);
    ?>
</header>
<main class="page-wrapper content-container">

    <form action="crud/create-lesson.php" method="post">
        <h2>Page Content</h2>
        <input class="text-input edit-input" id="title" name="title" placeholder="Lesson Title" required />
        <label for="title"></label>

        <textarea class="text-input edit-text-area" id="content" name="content" placeholder="Lesson Content" rows="10" required></textarea>
        <label for="content"></label>

        <h2 class="demo-options-editor-title">Demo Items</h2>

        <section class="demo-options-editor-container" id="demo-items">

        </section>

        <section>
            <button class="btn btn-dark-blue next-btn" onclick="addNewDemoOptionToForm()">Add Item</button>
            <button class="btn next-btn" onclick="removeLastDemoOptionFromForm()">Remove Item</button>
        </section>

        <section class="submit-buttons-container">
            <button class="btn btn-red next-btn">Cancel</button>
            <button type="submit" class="btn btn-green next-btn">Save</button>
        </section>
    </form>

</main>
<script src="js/edit-lesson.js"></script>

</body>
</html>
