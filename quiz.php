<?php
include './util/fetch.php';
include 'component.php'; // banner code
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Quiz';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // mark the quiz
    $quiz = get_quiz($_POST["id"])[0];
    $questions = get_quiz_questions($_POST["id"]);

    $results = mark_questions($questions);

} else {
    // GET request - display the quiz to be completed
    $quiz = get_quiz($_GET["id"])[0];
    $questions = get_quiz_questions($_GET["id"]);
    $results = [];
}

function mark_questions($questions) {
    $results = [];
    foreach ($questions as $question) {
        if ($question["type"] == "MULTI") {
            if (array_key_exists($question["id"], $_POST["answers"])) {
                $user_response = $_POST["answers"][$question["id"]];
                $correct_answers = array_filter($question["answers"], function($ans) {
                    return $ans["is_correct"] == true;
                });
                $correct_answers = array_column($correct_answers, "id");
                $results[$question["id"]] = $user_response == $correct_answers;
            } else {
                $results[$question["id"]] = false;
            }
        } elseif ($question["type"] == "TEXT") {
            $user_response = $_POST["answers"][$question["id"]];
            $correct_answer = $question["answers"][0]["label"];
            // check if user answer contains the substring of the answer - equivalent to doing LIKE '%answer%' query
            $results[$question["id"]] = str_contains($user_response, $correct_answer);
        }
    }

    return $results;
}

function displayPageTitle($title){
    echo '<h1 class="main-heading">'.trim($title).'</h1>';
}

function generate_question_answer_response_header_postfix($question_id) {
    global $results;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $is_correct = $results[$question_id];
        if ($is_correct) {
            return ' - CORRECT';
        }
        return ' - INCORRECT';
    }
    return '';
}

function displayQuestionInput($question_id, $heading)
{
    echo '<div class="input-question">';
    echo '<h2 class="sub-heading">' . htmlspecialchars(addslashes($heading)) . generate_question_answer_response_header_postfix($question_id) . '</h2>';
    echo "<input placeholder='type answer...' class='quiz-input' type='text' id='q$question_id-input' name='answers[$question_id]' required>";
    echo "<label class='hidden-label' for='q$question_id-input'>Question$question_id</label>";
    echo '</div>';
}

function displayQuestionRadio($question_id, $question, $answers)
{
    echo '<div class="quiz-stack">';
    echo '<h2 class="sub-heading">' . $question . generate_question_answer_response_header_postfix($question_id) . '</h2>';
    echo '<div class="radio-btn-stack">';
    for ($j=0; $j<count($answers); $j++) {
        $content = htmlspecialchars(addslashes($answers[$j]["label"]));
        $answer_id = $answers[$j]["id"];
        echo "<input type='radio' name='answers[$question_id][]' value='$answer_id'><label class='radio-label' id='q$question_id-option$j' for='q$question_id-option$j'>$content</label>";
    }
    echo '</div>';
    echo '</div>';
}

function displayQuestionCheck($question_id, $question, $answers)
{
    echo '<div class="quiz-stack">';
    echo '<h2 class="sub-heading">' . $question . generate_question_answer_response_header_postfix($question_id) . '</h2>';
    echo '<div class="radio-btn-stack">';
    for ($j=0; $j<count($answers); $j++) {
        $content = htmlspecialchars(addslashes($answers[$j]["label"]));
        $answer_id = $answers[$j]["id"];
        echo "<input type='checkbox' name='answers[$question_id][]' value='$answer_id'><label class='checkbox-label' id='q$question_id-option$j' for='q$question_id-option'>$content</label>";
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
    generateBanner($backLinkURL,$bannerText,false, true, false);
    ?>
</header>
<main class="page-wrapper ">
    <div class="quiz-wrapper">
    <section class= "information-section">
        <form action="quiz.php" method="POST">
            <?php
             displayPageTitle($quiz['title']);

            if (array_key_exists("id", $_GET)) {
                $lesson_id = $_GET["id"];
                echo "<input type=\"hidden\" name=\"id\" value=\"$lesson_id\" />";
            }

             for ($i = 0; $i < count($questions); $i++) {

                 $answer_counts = array_count_values(array_column($questions[$i]["answers"], "is_correct"));
                 $correct_answer_count = 0;
                 if (array_key_exists(1, $answer_counts)) {
                     $correct_answer_count = $answer_counts[1];
                 }

                 if ($questions[$i]['type'] == 'TEXT') {
                     // render input question
                     displayQuestionInput($questions[$i]["id"], $questions[$i]["question"]);
                 } elseif ($questions[$i]['type'] == 'MULTI' && $correct_answer_count == 1) {
                     // render radio button question
                     displayQuestionRadio($questions[$i]["id"], $questions[$i]["question"], $questions[$i]["answers"]);
                 } elseif ($questions[$i]['type'] == 'MULTI' && $correct_answer_count != 1){
                     // render check box question
                     displayQuestionCheck($questions[$i]["id"], $questions[$i]["question"], $questions[$i]["answers"]);
                 }
             }
            ?>
            <section class="submit-buttons-container">
                <button type="submit" class="btn btn-green next-btn">Submit</button>
            </section>
        </form>
    </section>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correct_answer_count = array_sum($results);
            $mark = $correct_answer_count . " out of " . sizeof($questions);
            $score = $correct_answer_count * 100;
            $points = $correct_answer_count * 100;
            echo "<div class='notification-box'><div class='mark-box'><div>";
            echo "<p class='notification-box-content'>Mark: <span id='mark'>$mark</span></p>";
            echo "<p class='notification-box-content'>Score: <span id='score'>$score</span></p>";
            echo "<p class='notification-box-content'>Points: <span id='points'>+$points gained!</span></p>";
            echo "</div>";
            echo "<img id='mascot-img' src='assets/img/avatars/avatar3.png' alt='mascot'>";
            echo "</div></div>";
        }
    ?>
    
<div class="footer-container">
<!--    TODO FIX -->
    <a href="article.php" class="btn btn-default btn-footer ">Previous</a>
    <a href="article2.php" class="btn btn-footer btn-yellow" ><b>Next</b></a>
</div>
</main>

</body>
</html>

