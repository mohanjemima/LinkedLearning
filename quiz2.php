<?php
include 'component.php'; // banner code
include './assets/data/sample-data.php'; // sample data
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Quiz';
$showBackLink = false;
$showHomeLink = true;

$lessons= getQuizzes();

$index = array_search( 'q2', array_column($lessons, 'lessonID'));

function displayPageTitle($title){
    echo'    <h1 class="main-heading">'.trim($title).'</h1>';
}

function displayQuestionInput($i, $heading)
{
    echo '<div class="input-question">';
    echo '<h2 class="sub-heading">' . $heading . '</h2>';
    echo '<input placeholder="type answer..." class="quiz-input" type="text" id="q' . $i . '-input">';
    echo '<label class="hidden-label" for="q' . $i . '-input">Question' . $i . '</label>';
    echo '</div>';
}

function displayQuestionRadio($i, $heading, $content)
{
    echo '<div class="quiz-stack">';
    echo '<h2 class="sub-heading">' . $heading . '</h2>';
    echo '<div class="radio-btn-stack">';
    for ($j=0; $j<count($content); $j++) {
        echo '<input type="radio" name="question' . $i . '"><label class="radio-label" id="q' . $i . '-option' . $j . '" for="q' . $i . '-option' . $j . '">' . $content[$j]['choice'] . '</label>';
    }
    echo '</div>';
    echo '</div>';
}

function displayQuestionCheck($i, $heading, $content)
{
    echo '<div class="quiz-stack">';
    echo '<h2 class="sub-heading">' . $heading . '</h2>';
    echo '<div class="radio-btn-stack">';
    for ($j=0; $j<count($content); $j++) {
        echo '<input type="checkbox" name="question' . $i . '"><label class="checkbox-label" id="q' . $i . '-option' . $j . '" for="q' . $i . '-option' . $j . '">' . $content[$j]['choice'] . '</label>';
    }
    echo '</div>';
    echo '</div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning |Quiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/lesson-content.css">
</head>
<body>
<header>
    <?=
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText,$showBackLink, $showHomeLink);
    ?>
</header>
<main class="page-wrapper ">
    <div class="quiz-wrapper">
    <section class= "information-section">
     <?php   displayPageTitle($lessons[$index]['pageTitle']);

     for ($i = 0; $i < count($lessons[$index]['paragraphs']); $i++) {
             if ($lessons[$index]['paragraphs'][$i]['displayType'] == 'input') {
                 // render input question
                 displayQuestionInput($i,$lessons[$index]['paragraphs'][$i]['heading']);
             } elseif ($lessons[$index]['paragraphs'][$i]['displayType'] == 'radio') {
                 // render radio button question
                 displayQuestionRadio($i,$lessons[$index]['paragraphs'][$i]['heading'],$lessons[$index]['paragraphs'][$i]['content']);
             } elseif ($lessons[$index]['paragraphs'][$i]['displayType'] == 'check'){
                 //render check box question
                 displayQuestionCheck($i,$lessons[$index]['paragraphs'][$i]['heading'],$lessons[$index]['paragraphs'][$i]['content']);
             }
         }
     ?>
    </section>
    </div>

<div class="footer-container">
    <a href="article.php" class="btn btn-default btn-footer ">Previous</a>
<!--    <a href="article2.php" class="btn btn-footer btn-yellow" ><b>Next</b></a>-->
</div>
</main>

</body>
</html>

