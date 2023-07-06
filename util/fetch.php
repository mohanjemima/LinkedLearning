<?php
include 'connection.php';

function get_associative_result_list($result): array
{
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function fetch($query): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $query");
    $stmt->execute();
    $result = $stmt->get_result();
    return get_associative_result_list($result);
}

function list_all_content()
{
    $lessons = array_reduce(get_lessons(), function ($result, $item) {
        $result[strval($item["id"] + 0.1)] = $item;
        return $result;
    }, array());
    $quizzes = array_reduce(get_quizzes(), function ($result, $item) {
        $count = 0.2;
        foreach (array_keys($result) as $key) {
            if (str_contains($key, strval($item["lesson_id"]))) {
                $count += 0.1;
            }
        }

        $result[strval($item["lesson_id"] + $count)] = $item;
        return $result;
    }, array());

    $list = $lessons + $quizzes;
    ksort($list);
    return array_values($list);
}

function get_lessons(): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Lesson");
    $stmt->execute();
    $result = $stmt->get_result();
    return get_associative_result_list($result);
}

function get_lesson($lesson_id): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Lesson WHERE id = ?");
    $stmt->bind_param("i", $lesson_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return get_associative_result_list($result);
}

function get_demo_items($lesson_id): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM DemoItem WHERE lesson_id = ?");
    $stmt->bind_param("i", $lesson_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return get_associative_result_list($result);
}

function get_quizzes(): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Quiz");
    $stmt->execute();
    $result = $stmt->get_result();
    return get_associative_result_list($result);
}

function get_quiz($quiz_id): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Quiz WHERE id = ?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return get_associative_result_list($result);
}

function get_quiz_questions($quiz_id): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM QuizQuestion WHERE quiz_id = ?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $questions = get_associative_result_list($result);

    foreach ($questions as &$question) {
        $question["answers"] = get_quiz_question_answers($question["id"]);
    }

    return $questions;
}

function get_quiz_question_answers($quiz_question_id): array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM QuizAnswer WHERE quiz_question_id = ?");
    $stmt->bind_param("i", $quiz_question_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return get_associative_result_list($result);
}

//include 'connection.php';
//
//function get_associative_result_list($result) {
//    $rows = array();
//    while ($row = $result->fetch_assoc()) {
//        $rows[] = $row;
//    }
//    return $rows;
//}
//
//function fetch($query) {
//    global $conn;
//    $result = $conn->query("SELECT * FROM $query;");
//    return get_associative_result_list($result);
//}
//
//function list_all_content() {
//    // store under lesson keys to enable merging then conversely sorting of items
//    $lessons = array_reduce(get_lessons(), function($result, $item) {
//        $result[strval($item["id"] + 0.1)] = $item;
//        return $result;
//    }, array());
//    $quizzes = array_reduce(get_quizzes(), function($result, $item) {
//        $count = 0.2;
//        foreach(array_keys($result) as $key) {
//            if(strpos($key, strval($item["lesson_id"])) > -1){
//                $count += 0.1;
//            }
//        }
//
//        $result[strval($item["lesson_id"] + $count)] = $item;
//        return $result;
//    }, array());
//
//    $list = $lessons + $quizzes;
//    ksort($list);
//    return array_values($list);
//}
//
//function get_lessons() {
//    return fetch("Lesson");
//}
//
//function get_lesson($lesson_id) {
//    global $conn;
//    $lesson_id = mysqli_real_escape_string($conn, $lesson_id);
//    return fetch("Lesson WHERE id=$lesson_id");
//}
//
//function get_demo_items($lesson_id) {
//    global $conn;
//    $lesson_id = mysqli_real_escape_string($conn, $lesson_id);
//    return fetch("DemoItem WHERE lesson_id=$lesson_id");
//}
//
//function get_quizzes() {
//    return fetch("Quiz");
//}
//
//function get_quiz($quiz_id) {
//    global $conn;
//    $quiz_id = mysqli_real_escape_string($conn, $quiz_id);
//    return fetch("Quiz WHERE id=$quiz_id");
//}
//
//function get_quiz_questions($quiz_id) {
//    global $conn;
//    $quiz_id = mysqli_real_escape_string($conn, $quiz_id);
//    $questions = fetch("QuizQuestion WHERE quiz_id=$quiz_id");
//    for ($i = 0; $i < count($questions); $i++) {
//        $questions[$i]["answers"] = get_quiz_question_answers($questions[$i]["id"]);
//    }
//    return $questions;
//}
//
//function get_quiz_question_answers($quiz_question_id) {
//    global $conn;
//    $quiz_id = mysqli_real_escape_string($conn, $quiz_question_id);
//    return fetch("QuizAnswer WHERE quiz_question_id=$quiz_question_id");
//}
