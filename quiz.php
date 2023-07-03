<?php
include './util/fetch.php';
include 'component.php'; // banner code
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Quiz';
$showBackLink = false;
$showHomeLink = true;

$quiz = get_quiz($_GET["id"])[0];
$questions = get_quiz_questions($_GET["id"]);

function displayPageTitle($title){
    echo '<h1 class="main-heading">'.trim($title).'</h1>';
}

function displayQuestionInput($i, $heading)
{
    echo '<div class="input-question">';
    echo '<h2 class="sub-heading">' . htmlspecialchars(addslashes($heading)) . '</h2>';
    echo '<input placeholder="type answer..." class="quiz-input" type="text" id="q' . $i . '-input">';
    echo '<label class="hidden-label" for="q' . $i . '-input">Question' . $i . '</label>';
    echo '</div>';
}

function displayQuestionRadio($i, $question, $answers)
{
    echo '<div class="quiz-stack">';
    echo '<h2 class="sub-heading">' . $question . '</h2>';
    echo '<div class="radio-btn-stack">';
    for ($j=0; $j<count($answers); $j++) {
        echo '<input type="radio" name="question' . $i . '"><label class="radio-label" id="q' . $i . '-option' . $j . '" for="q' . $i . '-option' . $j . '">' . htmlspecialchars(addslashes($answers[$j]["label"])) . '</label>';
    }
    echo '</div>';
    echo '</div>';
}

function displayQuestionCheck($i, $question, $answers)
{
    echo '<div class="quiz-stack">';
    echo '<h2 class="sub-heading">' . $question . '</h2>';
    echo '<div class="radio-btn-stack">';
    for ($j=0; $j<count($answers); $j++) {
        echo '<input type="checkbox" name="question' . $i . '"><label class="checkbox-label" id="q' . $i . '-option' . $j . '" for="q' . $i . '-option' . $j . '">' . htmlspecialchars(addslashes($answers[$j]["label"])) . '</label>';
    }
    echo '</div>';
    echo '</div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Quiz</title>
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
     <?php
         displayPageTitle($quiz['title']);

         for ($i = 0; $i < count($questions); $i++) {

             $answer_counts = array_count_values(array_column($questions[$i]["answers"], "is_correct"));
             $correct_answer_count = 0;
             if (array_key_exists(1, $answer_counts)) {
                 $correct_answer_count = $answer_counts[1];
             }

             if ($questions[$i]['type'] == 'TEXT') {
                 // render input question
                 displayQuestionInput($i, $questions[$i]["question"]);
             } elseif ($questions[$i]['type'] == 'MULTI' && $correct_answer_count == 1) {
                 // render radio button question
                 displayQuestionRadio($i, $questions[$i]["question"], $questions[$i]["answers"]);
             } elseif ($questions[$i]['type'] == 'MULTI' && $correct_answer_count != 1){
                 // render check box question
                 displayQuestionCheck($i, $questions[$i]["question"], $questions[$i]["answers"]);
             }
         }
     ?>
    </section>
    </div>

    <div class="notification-box">
        <div class="mark-box">
            <div>
            <p class="notification-box-content">Mark: <span id="mark"></span></p>
            <p class="notification-box-content">Score: <span id="score"></span></p>
            <p class="notification-box-content">Points: + <span id="points"></span></p>
            </div>
            <img id="mascot-img" src="assets/img/avatars/avatar3.png" alt="mascot">
        </div>
    </div>    
    
<div class="footer-container">
    <a href="article.php" class="btn btn-default btn-footer ">Previous</a>
    <a href="article2.php" class="btn btn-footer btn-yellow" ><b>Next</b></a>
</div>
</main>

</body>
</html>

