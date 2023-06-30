<?php
include 'util/fetch.php';
include 'component.php'; // banner code

// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Dashboard';
$showBackLink = false;
$showHomeLink = false;

$lessons= get_lessons();

function lessonRow($title,$isFirst,$href){
    $id='';
    if($isFirst){
        $id='id="first"';
    }
    echo '<li class="link-list-item" '.$id.'><a class="link-list-link"  href="'.$href.'" >'.$title.'</a></li>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Staff Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/staff-dashboard.css">
    <link rel="stylesheet" href="css/lesson-list.css">
</head>

<body>
<header>
    <?=
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText,$showBackLink, $showHomeLink);
    ?>
</header>
<main class="page-wrapper ">
    <div class="staff-dashboard">
        <section class="left-link-section box box-blue link-list-box disable">
            <h1 class="link-list-heading">Available Lessons</h1>
            <ul class = "lesson-link-list staff-sizing scroll-bar">
                <?php
                for ($i = 0; $i < count($lessons); $i++) {
                    if($i==0){ $isFirst = true; }else{ $isFirst=false; }
                    lessonRow($lessons[$i]['title'],$isFirst,'./edit-lesson.php?id='.$lessons[$i]['id']);
                }
                ?>
            </ul>
        </section>

        <div class="right-button-section">
            <div  class="box box-dark-blue box-square disable">
                <img class="staff-avatar-img" src="assets/img/avatars/staff-avatar.png" alt="generic user icon ">
                <h2 class="box-square-headings">Staff Name</h2>
            </div>

            <a href="edit-lesson.php" class="box box-green box-square ">
                <img class="box-square-img" src="assets/img/new-lesson-icon.svg" alt="new file icon">
                <h2 class="box-square-headings">New Lesson</h2>
            </a>

        </div>
    </div>
</main>

</body>
</html>