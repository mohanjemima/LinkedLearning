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

//include(dirname(__DIR__).'/util/connection.php');
//include(dirname(__DIR__).'/util/fetch.php');
//
//$lesson = null;
//$title = mysqli_real_escape_string($conn, $_POST['title']);
//$content = mysqli_real_escape_string($conn, $_POST['content']);
//
//if (array_key_exists("id", $_POST)) {
//    // UPDATE
//    $lesson = get_lesson(mysqli_real_escape_string($conn, $_POST["id"]));
//    if (sizeof($lesson) == 0) {
//        header("Location: ..\staff-dashboard.php");
//    }
//    $lesson_id = mysqli_real_escape_string($conn, $lesson[0]["id"]);
//    $sql = "UPDATE Lesson SET title='$title', content='$content' WHERE id=$lesson_id";
//} else {
//    // NEW - CREATE
//    $sql = "INSERT INTO Lesson (title, content) VALUES ('$title', '$content')";
//}
//
//// Attempt insert query execution
//if ($conn->query($sql)) {
//
//    if ($lesson == null) {
//        $lesson_id = $conn->insert_id;
//    } else {
//        $lesson_id = $lesson[0]["id"];
//    }
//
//    if (array_key_exists("id", $_POST)) {
//        $conn->query("DELETE FROM DemoItem WHERE lesson_id=$lesson_id");
//    }
//
//    if (array_key_exists("demo-option-header", $_POST)) {
//        // Demo items exist - save appropriately
//        $iterator = new MultipleIterator(MultipleIterator::MIT_NEED_ALL|MultipleIterator::MIT_KEYS_ASSOC);
//        $iterator->attachIterator(new ArrayIterator($_POST["demo-option-header"]), "demo-option-header");
//        $iterator->attachIterator(new ArrayIterator($_POST["demo-option-content"]), "demo-option-content");
//
//        foreach ($iterator as $demo_option) {
//            $display_label = mysqli_real_escape_string($conn, $demo_option["demo-option-header"]);
//            $html_content = mysqli_real_escape_string($conn, $demo_option["demo-option-content"]);
//            $sql = "INSERT INTO DemoItem (display_label, html_content, lesson_id) VALUES ('$display_label', '$html_content', '$lesson_id')";
//            if (!mysqli_query($conn, $sql)) {
//                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
//            }
//        }
//
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
//
