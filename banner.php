<?php
function generateBanner($backLinkURL,$bannerText,$showBackLink,$showHomeLink)
{
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>Linked Learning | Article & Demo</title>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">';
    echo '<link rel="stylesheet" href="css/normalize.css">';
    echo '<link rel="stylesheet" href="css/banner.css">';
    echo '<link rel="stylesheet" href="css/main.css">';
    echo '</head>';
    echo '<header>';
    echo '<div class="banner">';
    echo '<div class="img-text-section">';
    echo '    <div class="container">';
    echo '        <img src="./assets/img/banner-logo.svg" alt="Long Image" class="banner-image">';
    echo '    </div>';
    echo '    <p class="heading-text">' . $bannerText . '</p>';
    echo '</div>';
    if($showBackLink || $showHomeLink) {
        echo '<div class="banner-links">';
        if ($showBackLink) {
            echo '<a href="' . $backLinkURL . '" class="banner-link">';
            echo '<b>&lt;&lt;</b> Back</a>';
        }
        if ($showHomeLink) {
            echo '<a href="./dashboard.html" class="banner-link">';
            echo '<img src="./assets/img/home-icon.svg" alt="house icon" class="banner-link-icon">Home </a>';
        }
        echo '</div>';
    }
    echo '</div>';
    echo '</header>';
    echo '</html>';
}
?>

