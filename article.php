<?php
include 'component.php'; // banner code
include './util/fetch.php';
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Article';

$lesson = get_lesson($_GET["id"])[0];
$demo_items = get_demo_items($_GET["id"]);

function displayPageTitle($title){
    $title = htmlspecialchars(addslashes($title));
    echo "<h1 class=\"main-heading\">$title</h1>";
}
function displayListItem($content) {
    $content = htmlspecialchars(addslashes($content));
    echo "<li class=\"paragraph\">$content</li>";

}

function displayParagraphText($content) {
    $content = htmlspecialchars(addslashes($content));
    echo "<p class=\"paragraph\">$content</p>";
}

function displayHeadingText($heading) {
    $heading = htmlspecialchars(addslashes($heading));
    echo "<h3 class=\"text-block-heading\">$heading</h3>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | Article & Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/lesson-content.css">
</head>
<body>
<header>
    <?=
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText, false, true,false);
    ?>
</header>
<main class="page-wrapper content-container">

    <section class= "information-section">
    <?php
//    ARTICLE HEADING
    displayPageTitle($lesson['title']);

    $content_lines = preg_split("/\r\n|\n|\r/", $lesson['content']);
    $is_code_block_open = false;
    $is_list_open = false;

    //    ARTICLE PARAGRAPHS
    for ($i = 0; $i < count($content_lines); $i++) {
        if (trim($content_lines[$i]) == "```") {
            // handle surrounding code block display
            if ($is_code_block_open) {
                // close code block
                echo '</code></pre>';
                $is_code_block_open = false;
            } else {
                // open code block
                echo '<pre class="pre-display"><code class="code-display">';
                $is_code_block_open = true;
            }
        } else if ($is_code_block_open) {
            echo $content_lines[$i]."<br />";
        } elseif (str_starts_with(trim($content_lines[$i]), "# ")) {
            // Display text as heading
            displayHeadingText(substr($content_lines[$i], 2));
        } elseif (str_starts_with(trim($content_lines[$i]), "---")) {
            // Display text as list
            if ($is_list_open) {
                echo "</ul>";
                $is_list_open = false;
            } else {
                echo "<ul>";
                $is_list_open = true;
            }
        } else if ($is_list_open) {
            displayListItem($content_lines[$i]);
        } else {
            // display text as paragraph
            displayParagraphText($content_lines[$i]);
        }
    }
    ?>
    </section>

    <h3 style="<?php if (sizeof($demo_items) == 0) { echo "display: none;"; } ?>">Demo</h3>
    <div class="demo-container box box-dark-blue disable" style="<?php if (sizeof($demo_items) == 0) echo "display: none;" ?>">
        <div class="demo-btn-list" id="demo-options-list">
            <?php
                for ($i = 0; $i < count($demo_items); $i++) {
                    $label = $demo_items[$i]["display_label"];
                    $html_content = $demo_items[$i]["html_content"];
                    if ($i == 0) {
                        echo "<button class=\"btn demo-btn btn-dark-blue\" value=\"$html_content\" onclick=\"changeDemoItem(this)\">$label</button>";
                    } else {
                        echo "<button class=\"btn demo-btn\" value=\"$html_content\" onclick=\"changeDemoItem(this)\">$label</button>";
                    }
                }
            ?>
        </div>
        <div class="box-dark-blue demo-inner-container disable" id="demo-container">
            <h1><?php if (sizeof($demo_items) != 0) echo $demo_items[0]["html_content"] ?></h1>
        </div>
    </div>

    <div class="footer-container">
        <a href="#" class="btn btn-footer btn-default hidden-label">Previous</a>
        <a href="quiz.php" class="btn btn-footer btn-yellow" ><b>Next</b></a>
    </div>

</main>

<script src="./js/article-demo.js"></script>
</body>
</html>