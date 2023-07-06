<?php

include(dirname(__DIR__) . '/util/connection.php');
include(dirname(__DIR__) . '/util/fetch.php');

$quiz = null;
$title = $_POST['title'];
$lesson_id = $_POST['lesson'];

if (array_key_exists("id", $_POST)) {
    // UPDATE
    $quiz = get_quiz($_POST["id"]);
    if (empty($quiz)) {
        header("Location: ../staff-dashboard.php");
        exit();
    }
    $quiz_id = $quiz[0]["id"];
    $sql = "UPDATE Quiz SET title=?, lesson_id=? WHERE id=?";
} else {
    // NEW - CREATE
    $sql = "INSERT INTO Quiz (title, lesson_id) VALUES (?, ?)";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $title, $lesson_id, $quiz_id);

// Attempt insert/update query execution
if ($stmt->execute()) {
    if ($quiz == null) {
        $quiz_id = $stmt->insert_id;
    } else {
        $quiz_id = $quiz[0]["id"];
    }

    // Clear down old questions and answers to make updates behave like an overwrite
    if (array_key_exists("id", $_POST)) {
        foreach (get_quiz_questions($quiz_id) as $question) {
            $question_id = $question["id"];
            $stmt = $conn->prepare("DELETE FROM QuizAnswer WHERE quiz_question_id=?");
            $stmt->bind_param("i", $question_id);
            $stmt->execute();
        }
        $stmt = $conn->prepare("DELETE FROM QuizQuestion WHERE quiz_id=?");
        $stmt->bind_param("i", $quiz_id);
        $stmt->execute();
    }

    foreach ($_POST["questions"] as $question) {
        $question_text = $question["question"];
        $question_type = $question["type"];
        $stmt = $conn->prepare("INSERT INTO QuizQuestion (question, type, quiz_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $question_text, $question_type, $quiz_id);
        $stmt->execute();

        $question_id = $stmt->insert_id;

        foreach ($question["answers"] as $answer) {
            $answer_text = $answer["label"];
            $is_correct = array_key_exists("is_correct", $answer) ? 1 : 0;
            $stmt = $conn->prepare("INSERT INTO QuizAnswer (label, is_correct, quiz_question_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $answer_text, $is_correct, $question_id);
            $stmt->execute();
        }
    }

    header("Location: ../staff-dashboard.php");
    exit();
} else {
    echo "ERROR: Could not execute the query: " . $stmt->error;
}

$stmt->close();
$conn->close();
exit();

//include(dirname(__DIR__).'/util/connection.php');
//include(dirname(__DIR__).'/util/fetch.php');
//
//$quiz = null;
//$title = mysqli_real_escape_string($conn, $_POST['title']);
//$lesson_id = mysqli_real_escape_string($conn, $_POST['lesson']);
//
//if (array_key_exists("id", $_POST)) {
//    // UPDATE
//    $quiz = get_quiz(mysqli_real_escape_string($conn, $_POST["id"]));
//    if (sizeof($quiz) == 0) {
//        header("Location: ..\staff-dashboard.php");
//    }
//    $quiz_id = mysqli_real_escape_string($conn, $quiz[0]["id"]);
//    $sql = "UPDATE Quiz SET title='$title', lesson_id=$lesson_id WHERE id=$quiz_id";
//} else {
//    // NEW - CREATE
//    $sql = "INSERT INTO Quiz (title, lesson_id) VALUES ('$title', '$lesson_id')";
//}
//
//// Attempt insert query execution
//if ($conn->query($sql)) {
//
//    if ($quiz == null) {
//        $quiz_id = $conn->insert_id;
//    } else {
//        $quiz_id = $quiz[0]["id"];
//    }
//
//    // Clear down old questions and answers to make updates behave like an overwrite
//    if (array_key_exists("id", $_POST)) {
//        foreach (get_quiz_questions($quiz_id) as $question) {
//            $question_id = $question["id"];
//            $conn->query("DELETE FROM QuizAnswer WHERE quiz_question_id=$question_id");
//        }
//        $conn->query("DELETE FROM QuizQuestion WHERE quiz_id=$quiz_id");
//    }
//
//    foreach ($_POST["questions"] as $question) {
//        $question_text = mysqli_real_escape_string($conn, $question["question"]);
//        $question_type = mysqli_real_escape_string($conn, $question["type"]);
//        $conn->query("INSERT INTO QuizQuestion (question, type, quiz_id) VALUES ('$question_text', '$question_type', $quiz_id)");
//
//        $question_id = $conn->insert_id;
//
//        foreach ($question["answers"] as $answer) {
//            $answer_text = mysqli_real_escape_string($conn, $answer["label"]);
//            $is_correct = 0;
//            if (array_key_exists("is_correct", $answer)) {
//                $is_correct = 1;
//            }
//            $conn->query("INSERT INTO QuizAnswer (label, is_correct, quiz_question_id) VALUES ('$answer_text', $is_correct, $question_id)");        }
//    }
//
//    header("Location: ..\staff-dashboard.php");
//
//} else {
//    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
//}
//
//mysqli_close($conn);
//exit();
