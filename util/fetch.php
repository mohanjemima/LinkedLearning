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


function updateCurrentLessonID($user_id, $new_id): void
{
    global $conn;
    $sql ="UPDATE User SET current_lesson_id='$new_id' WHERE  id ='$user_id'";
    mysqli_query($conn,$sql);
}