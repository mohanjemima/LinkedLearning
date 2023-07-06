<?php
include 'component.php'; // banner code
include './crud/dashboard-data.php';
session_start();//start session for that page
check_user_access();

// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Dashboard';


$id = $_SESSION['userID'];

$user = get_user_record($id);

$childName = $user['name'];

$rank = get_user_rank($id);
$lessonsCompleted= $user['current_lesson_id'] ."/".get_no_available_lessons();
$points= $user['points'];
$title = get_title($user['current_lesson_id']);
$content = get_content($user['current_lesson_id']);

$articleURL ="./article.php?id=".$user['current_lesson_id'] ;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/user-dashboard.css">
</head>
<body>
<header>
    <?=
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText, false, false, true);
    ?>
</header>
<main class="page-wrapper user-dash-wrapper ">

    <section class="user-left-section">
        <div class="user-small-box-section">
            <a href="scores-rewards.php#Leaderboard" class="box box-yellow box-small-rectangle">
                <img class="small-box-img" src="assets/img/scores-icon.svg" alt="medal icon in circle">
                <h2 class="box-heading">Scores</h2>
            </a>
            <a href="scores-rewards.php#Rewards" class="box box-red box-small-rectangle">
                <img class="small-box-img" src="assets/img/rewards-icon.svg" alt="star icon in circle">
                <h2 class="box-heading">Rewards</h2>
            </a>
            <a href="lesson-list.php" class="box box-blue box-small-rectangle">
                <img class="small-box-img" src="assets/img/lessons-icon.svg" alt="code icon in circle">
                <h2 class="box-heading">Lessons</h2>
            </a>
        </div>
        <a href=<?=$articleURL?> class="box box-dark-blue box-wide-rectangle">
        <img id="pin-img" src="assets/img/pin-icon.svg" alt="pin icon">
        <div class="lesson-section">

            <h1 id="lesson-section-heading"><?=$title;?></h1>
            <p id="lesson-section-description" aria-valuemax="405">
                <?=$content;?>
            </p>
        </div>
        </a>
    </section>

    <div  class="box box-green box-long-rectangle disable">
        <?=generateProfilePic()?>
        <div class="details">
            <h2 class="box-heading"><?= $childName?></h2>

            <section class="ranking-info-item-row">
                <div class="ranking-info-item">
                    <h3 class="ranking-info-item-label"> Ranking</h3>
                    <p class="ranking-info-item-content" id="rank">
                        <?=$rank?><span id="place-format"></span>
                    </p>
                </div>
                <div class="ranking-info-item">
                    <h3 class="ranking-info-item-label"> Lesson</h3>
                    <p class="ranking-info-item-content"><?=$lessonsCompleted?></p>
                </div>
                <div class="ranking-info-item">
                    <h3 class="ranking-info-item-label"> Points</h3>
                    <p class="ranking-info-item-content" id="points"><?=$points?></p>
                </div>
            </section>
            <section class="awards-section">
                <h3 class="ranking-info-item-label">Awards</h3>

                <div class="award-section">
                    <div class="award-badge-row">
                        <button class="award-badge" id="Award1"><img src="assets/img/awards/award2.jpeg"></button>
                        <button class="award-badge" id="Award2"><img src="assets/img/awards/award1.jpeg"></button>
                        <button class="award-badge" id="Award3"><img src="assets/img/awards/award4.jpeg"></button>
                        <button class="award-badge" id="Award4"><img src="assets/img/awards/award7.jpeg"></button>
                        <button class="award-badge" id="Award5"><img src="assets/img/awards/award6.jpeg"></button>
                    </div>
                    <div class="award-badge-row">
                        <button class="award-badge" id="Award6"><img src="assets/img/awards/award3.jpeg"></button>
                        <button class="award-badge" id="Award7"><img src="assets/img/awards/award9.jpeg"></button>
                        <button class="award-badge" id="Award8"><img src="assets/img/awards/award8.jpeg"></button>
                        <button class="award-badge" id="Award9"><img src="assets/img/awards/award5.jpeg"></button>
                        <button class="award-badge" id="Award10"><img src="assets/img/awards/award10.jpeg"></button>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main>
<script src="./js/dashboard.js"></script>
</body>
</html>