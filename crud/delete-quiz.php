<?php

include(dirname(__DIR__) . '/util/connection.php');
include(dirname(__DIR__) . '/util/fetch.php');
global  $conn;
$quiz_id = $_POST["id"];
$stmt = $conn->prepare("DELETE FROM QuizAnswer WHERE quiz_question_id = ?");
$stmt->bind_param("i", $quiz_id);

$questions = get_quiz_questions($quiz_id);

foreach ($questions as $question) {
    $question_id = $question["id"];
    $stmt->execute();
}

$stmt = $conn->prepare("DELETE FROM QuizQuestion WHERE quiz_id = ?");
$stmt->bind_param("i", $quiz_id);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM Quiz WHERE id = ?");
$stmt->bind_param("i", $quiz_id);
$stmt->execute();

header("Location: ../staff-dashboard.php");

$stmt->close();
$conn->close();
exit();