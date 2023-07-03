<?php
include 'component.php'; // banner code
include './assets/data/sample-data.php'; // sample data
include 'util/fetch.php';

// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Lessons';
$showBackLink = false;
$showHomeLink = true;

$content = list_all_content();

function lessonRow($title, $href){
    echo '<li class="link-list-item"><a class="link-list-link"  href="'.$href.'" >'.$title.'</a></li>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Lessons</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/lesson-list.css">

</head>
<body>
<header>
    <?=
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText,$showBackLink, $showHomeLink);
    ?>
</header>
<main class="page-wrapper ">

    <div class="box box-blue link-list-box disable">
        <h1 class="link-list-heading">Available Lessons</h1>
        <ul class = "lesson-link-list lesson-link-list-sizing scroll-bar">

            <?php
            foreach ($content as $item) {
                if (array_key_exists("lesson_id", $item)) {
                    // is a quiz
                    $href = "./quiz.php?id=".$item["id"];
                } else {
                    // is a lesson
                    $href = "./article.php?id=".$item["id"];
                }
                lessonRow($item["title"], $href);
            }
            ?>
        </ul>
    </div>

</main>
</body>
</html>
