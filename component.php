<?php
include './crud/scores-rewards-data.php'; // sample data

function generateBanner($backLinkURL,$bannerText,$showBackLink,$showHomeLink,$showLogOut): void
{
    echo '<head>';
    echo '<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">';
    echo '<link rel="stylesheet" href="./css/banner.css">';
    echo '</head>';


    echo '<div class="banner">';
    echo '<div class="img-text-section">';
    echo '    <div class="container">';
    echo '        <img src="./assets/img/banner-logo.svg" alt="Long Image" class="banner-image">';
    echo '    </div>';
    echo '    <p class="heading-text">' . $bannerText . '</p>';
    echo '</div>';
    if($showBackLink || $showHomeLink || $showLogOut) {
        echo '<div class="banner-links">';

        if ($showLogOut) {
            echo '<a href="./crud/logout.php" class=" banner-link">';
            echo 'Logout</a>';
        }else if ($showBackLink) {
            echo '<a href="' . $backLinkURL . '" class="banner-link">';
            echo '<b>&lt;&lt;</b> Back</a>';
        }else if ($showHomeLink) {
            echo '<a href="./dashboard.php" class="banner-link">';
            echo '<img src="./assets/img/home-icon.svg" alt="house icon" class="banner-link-icon">Home </a>';
        }
        echo '</div>';
    }
    echo '</div>';
}

function generateProfilePic(): void
{
    $rewards = getRewards();
    echo '<div class="profile-picture-container">';
    echo '    <button class="edit-pp-btn" onclick="openPopup()" type="button">edit</button>';
    echo '    <img class="user-profile-img" id="selectedImage" src="assets/img/avatars/avatar6.png" alt="profile picture">';
    echo '</div>';

    echo '<div class="popup box-green" id="imagePopup">';
    echo '    <h2 class="sub-heading">Select an Image</h2>';
    echo '    <section class="images">';

    foreach ($rewards as $reward) {
        echo '        <img class="thumbnail thumbnail-img" src="./assets/img/avatars/'.$reward['img_address'].'" onclick="selectImage(\''.$reward['img_address'].'\')">';
    }
    echo '        <img class="thumbnail thumbnail-img" src="./assets/img/avatars/avatar6.png" onclick="selectImage(\'avatar6.png\')">';
    echo '    </section>';
    echo '</div>';

}


function check_user_access(): void
{
    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: log-in.php");
        exit();
    }
}
