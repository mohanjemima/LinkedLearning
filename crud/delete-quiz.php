<?php
include(dirname(__DIR__).'/util/connection.php');
include(dirname(__DIR__).'/util/fetch.php');

$quiz_id = mysqli_real_escape_string($conn, $_POST["id"]);

$questions = get_quiz_questions($quiz_id);

foreach ($questions as $question) {
    $question_id = $question["id"];
    $conn->query("DELETE FROM QuizAnswer WHERE quiz_question_id=$question_id");
}

$conn->query("DELETE FROM QuizQuestion WHERE quiz_id=$quiz_id");
$conn->query("DELETE FROM Quiz WHERE id=$quiz_id");

header("Location: ..\staff-dashboard.php");

mysqli_close($conn);
exit();

