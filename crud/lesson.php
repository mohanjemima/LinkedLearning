<?php

include(dirname(__DIR__) . '/util/connection.php');
include(dirname(__DIR__) . '/util/fetch.php');
global $conn;
$lesson = null;
$title = $_POST['title'];
$content = $_POST['content'];

if (array_key_exists("id", $_POST)) {
    // UPDATE
    $lesson = get_lesson($_POST["id"]);
    if (empty($lesson)) {
        header("Location: ../staff-dashboard.php");
        exit();
    }
    $lesson_id = $lesson[0]["id"];
    $sql = "UPDATE Lesson SET title=?, content=? WHERE id=?";
} else {
    // NEW - CREATE
    $sql = "INSERT INTO Lesson (title, content) VALUES (?, ?)";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $content, $lesson_id);

// Attempt insert/update query execution
if ($stmt->execute()) {
    if ($lesson == null) {
        $lesson_id = $stmt->insert_id;
    } else {
        $lesson_id = $lesson[0]["id"];
    }

    if (array_key_exists("id", $_POST)) {
        $stmt = $conn->prepare("DELETE FROM DemoItem WHERE lesson_id=?");
        $stmt->bind_param("i", $lesson_id);
        $stmt->execute();
    }

    if (array_key_exists("demo-option-header", $_POST)) {
        // Demo items exist - save appropriately
        $demoOptions = array_combine($_POST["demo-option-header"], $_POST["demo-option-content"]);
        $stmt = $conn->prepare("INSERT INTO DemoItem (display_label, html_content, lesson_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $display_label, $html_content, $lesson_id);

        foreach ($demoOptions as $display_label => $html_content) {
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

