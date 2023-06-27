<?php
include(dirname(__DIR__).'/util/connection.php');

print_r($_POST);
// Escape user inputs for security
$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

// Attempt insert query execution
$sql = "INSERT INTO Lesson (title, content) VALUES ('$title', '$content')";
if(mysqli_query($conn, $sql)){
    header("Location: ..\staff-dashboard.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
exit();
?>