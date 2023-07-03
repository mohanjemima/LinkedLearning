<?php
include 'component.php'; // banner code
include 'util/fetch.php';

// Customize the link URLs, text, and display status for Banner
$backLinkURL = './staff-dashboard.php';// back link for the back button
$bannerText = 'Dashboard';
$showBackLink = true;
$showHomeLink = false;

$title = "";
$quiz = "";

if (array_key_exists("id", $_GET)) {
    $quiz = get_quiz($_GET["id"]);
    if (sizeof($quiz) == 1) {
        $title = $quiz[0]["title"];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | New Quiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/lesson-content.css">
</head>
<body>
<header>
    <?php
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText,$showBackLink, $showHomeLink);
    ?>
</header>
<main class="page-wrapper content-container">

    <form action="crud/quiz.php<?php if (array_key_exists("id", $_GET)) { $quiz_id = $_GET["id"]; echo "?id=$quiz_id"; } ?>" method="post">
        <?php if (array_key_exists("id", $_GET)) { $quiz_id = $_GET["id"]; echo "<input type=\"hidden\" name=\"id\" value=\"$quiz_id\" />"; } ?>

        <h2>Quiz Content</h2>

        <label for="lesson">Choose the lesson this quiz will be associated with</label>
        <select name="lesson" id="lesson">
            <?php
                foreach(get_lessons() as $lesson) {
                    $lesson_id = $lesson["id"];
                    $lesson_title = $lesson["title"];
                    echo "<option value=\"$lesson_id\">$lesson_title</option>";
                }
            ?>
        </select>

        <input class="text-input edit-input" id="title" name="title" placeholder="Quiz Title" value="<?php echo $title?>" required />
        <label for="title"></label>

        <h2 class="demo-options-editor-title">Questions</h2>

        <section class="demo-options-editor-container" id="questions">

        </section>

        <section class="question-control-container">
            <button type="button" class="btn btn-dark-blue next-btn" onclick="addNewQuestionToForm()">Add Question</button>
            <button type="button" class="btn next-btn" onclick="removeLastQuestionFromForm()">Remove Question</button>
        </section>

        <section class="submit-buttons-container">
            <a href="./staff-dashboard.php"><button type="button" class="btn btn-red next-btn">Cancel</button></a>
            <button type="submit" class="btn btn-green next-btn">Save</button>
        </section>
    </form>

</main>
<script type="text/javascript">
    function addNewQuestionToForm(question="", type="") {
        let question_index = document.getElementById("questions").children.length;
        document.getElementById("questions").insertAdjacentHTML(
            "beforeend",
            `<div>` +
            `<input class=\"text-input edit-input\" name=\"questions[${question_index}][question]\" placeholder=\"Question ${question_index+1}\" value="${question}" required />\n` +
            `<div class="sign-up-quiz-stack">` +
            `<div class="radio-btn-stack">` +
            `<input type="radio" name="questions[${question_index}][type]" id="question-type-multi-${question_index}" ${["", "MULTI"].includes(type) ? "checked" : ""}><label class="radio-label" for="question-type-multi-${question_index}">Multiple Choice</label>` +
            `<input type="radio" name="questions[${question_index}][type]" id="question-type-text-${question_index}" ${type === "TEXT" ? "checked" : "unchecked"}><label class="radio-label" for="question-type-text-${question_index}">Text Input</label>` +
            `</div></div>`+
            `<section class="demo-options-editor-container" id="questionanswers-${question_index}"></section>` +
            `<section class="question-control-container">` +
            `<button type="button" class="btn btn-dark-blue next-btn" onclick="addNewQuestionAnswerToForm(${question_index})">Add Answer</button>` +
            `<button type="button" class="btn next-btn" onclick="removeLastQuestionAnswerFromForm(${question_index})">Remove Answer</button>` +
            `</section><hr /></div>`
        );
    }

    function removeLastQuestionFromForm() {
        let items = document.getElementById("questions");
        items.removeChild(items.lastChild);
    }

    function addNewQuestionAnswerToForm(question_index, answer="", is_correct=false) {
        let answer_index = document.getElementById("questionanswers-"+question_index).children.length;
        document.getElementById("questionanswers-"+question_index).insertAdjacentHTML(
            "beforeend",
            `<div>` +
            `<input class=\"text-input edit-input\" name=\"questions[${question_index}][answers][${answer_index}][label]\" placeholder=\"Answer ${answer_index+1}\" value=\"${answer}\" required />\n` +
            `<div class="sign-up-quiz-stack">` +
            `<div class="radio-btn-stack">` +
            `<input type="checkbox" name="questions[${question_index}][answers][${answer_index}][is_correct]" id="is_correct_${answer_index}" ${is_correct ? "checked": ""}><label class="radio-label" for="is_correct_${answer_index}">Correct Answer</label>` +
            `</div></div></div>`
        );
    }

    function removeLastQuestionAnswerFromForm(id) {
        let items = document.getElementById("questionanswers-"+id);
        items.removeChild(items.lastChild);
    }

    window.onload = function() {
        <?php
        if ($quiz != "") {
            $i = 0;
            foreach (get_quiz_questions($quiz[0]["id"]) as $question) {
                echo "addNewQuestionToForm(\"${question['question']}\", \"${question['type']}\");";

                foreach (get_quiz_question_answers($question["id"]) as $answer) {
                    $answer_label = $answer["label"];
                    $is_correct = $answer["is_correct"];
                    echo "addNewQuestionAnswerToForm(${i}, \"$answer_label\", $is_correct);";
                }
                $i++;
            }
        }

        ?>
    }
</script>
</body>
</html>
