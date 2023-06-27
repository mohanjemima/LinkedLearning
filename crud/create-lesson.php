<?php
include(dirname(__DIR__).'/util/connection.php');

echo phpversion();
print_r($_POST);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

// Attempt insert query execution
$sql = "INSERT INTO Lesson (title, content) VALUES ('$title', '$content')";
if ($conn->query($sql)) {

    $lesson_id = $conn->insert_id;

    if (array_key_exists("demo-option-header", $_POST)) {
        // Demo items exist - save appropriately
        $iterator = new MultipleIterator(MultipleIterator::MIT_NEED_ALL|MultipleIterator::MIT_KEYS_ASSOC);
        $iterator->attachIterator(new ArrayIterator($_POST["demo-option-header"]), "demo-option-header");
        $iterator->attachIterator(new ArrayIterator($_POST["demo-option-content"]), "demo-option-content");

        foreach ($iterator as $demo_option) {
            $display_label = mysqli_real_escape_string($conn, $demo_option["demo-option-header"]);
            $html_content = mysqli_real_escape_string($conn, $demo_option["demo-option-content"]);
            $sql = "INSERT INTO DemoItem (display_label, html_content, lesson_id) VALUES ('$display_label', '$html_content', '$lesson_id')";
            if (!mysqli_query($conn, $sql)) {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        }

    }

    header("Location: ..\staff-dashboard.php");

} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
exit();
