<?php
include 'connection.php';

function get_associative_result_list($result) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function fetch($query) {
    global $conn;
    $result = $conn->query("SELECT * FROM $query;");
    return get_associative_result_list($result);
}

function get_lessons() {
    return fetch("Lesson");
}

function get_lesson($lesson_id) {
    global $conn;
    $lesson_id = mysqli_real_escape_string($conn, $lesson_id);
    return fetch("Lesson WHERE id=$lesson_id");
}

function get_demo_items($lesson_id) {
    global $conn;
    $lesson_id = mysqli_real_escape_string($conn, $lesson_id);
    return fetch("DemoItem WHERE lesson_id=$lesson_id");
}


