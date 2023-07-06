<?php
include 'component.php'; // banner code
include './assets/data/sample-data.php'; // sample data
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Scores & Rewards';


$users =  getUsers();
$rewards = getRewards();

function leaderBoardRow($rank,$userName,$points){
    echo '<tr class="rows disable-row display-row-yellow">';
    echo '    <td class="leaderboard-column-items leaderboard-column-one">';
    echo '        <p class="leaderboard-column-one"><span class="marker">'.$rank.'.</span> <span id="username1">'.$userName.'</span></p>';
    echo '    </td>';
    echo '    <td class="leaderboard-column-items leaderboard-column-two">';
    echo '        <p class="leaderboard-column-two">'.$points.'</p>';
    echo '    </td>';
    echo '</tr>';
}

function rewardPrizeRows($img,$name,$cost){
    echo '<tr class="rows display-row-red">';
    echo '    <td class="rewards-image-column">';
    echo '        <img class="small-box-img" src="./assets/img/'.$img.'" alt="">';
    echo '    </td>';
    echo '    <td class="rewards-name-column">'.$name.'</td>';
    echo '    <td class="rewards-score-column">'.$cost.'</td>';
    echo '</tr>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Scores & Rewards</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/scores-rewards.css">

</head>
<body>
<header>
    <?=
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText,false, true, false);
    ?>
</header>
<main class="page-wrapper scores-rewards-wrapper">
    <section #href="#Leaderboard" class="box box-yellow leaderboard-box section-box disable">
        <h1 class="main-heading-scores">Leaderboard</h1>
        <table class="box-elements">
            <tr class="rows disable-row display-row-yellow">
                <th class="leaderboard-column-items column-headings leaderboard-column-one">Username</th>
                <th class="leaderboard-column-items column-headings leaderboard-column-two">Score</th>
            </tr>
            <?php
            for ($i = 0; $i < count($users); $i++) {
                leaderBoardRow(($i+1), $users[$i]['name'], $users[$i]['points']);
            }
            ?>
            <!-- Repeat rows for other users -->
        </table>
    </section>

    <section href="#Rewards" class="box box-red rewards-box section-box disable">
        <h1 class="main-heading-rewards">Rewards</h1>
        <table class="box-elements">
            <tr  class="rows disable-row display-row-red">
                <th class="column-headings rewards-image-column"></th>
                <th class="column-headings rewards-name-column"></th>
                <th class="column-headings rewards-score-column">Cost</th>
            </tr>
            <?php
            for ($i = 0; $i < count($rewards); $i++) {
                rewardPrizeRows($rewards[$i]['img'], $rewards[$i]['name'], $rewards[$i]['cost']);
            }
            ?>
            <!-- Repeat rows for other prizes -->
        </table>
    </section>
</main>
</body>
</html>
