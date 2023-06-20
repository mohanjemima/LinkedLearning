<?php
include 'component.php'; // banner code
include './assets/data/sample-data.php'; // sample data
// Customize the link URLs, text, and display status for Banner
$backLinkURL = '#';// back link for the back button
$bannerText = 'Article';
$showBackLink = false;
$showHomeLink = true;

$lessons= getArticles();

$index = array_search('l1', array_column($lessons, 'lessonID'));

function displayPageTitle($title){
    echo'    <h1 class="main-heading">'.trim($title).'</h1>';
}
function displayParagraphList($heading, $content){
$list = formatList($content);

    echo' <h3 class="text-block-heading">'.trim($heading).'</h3>';
    echo'<ul class="paragraph">'.trim($list).'</ul>';

}
function displayParagraphCodeExample($heading, $content){
    $codeText =  htmlentities($content);

    echo' <h3 class="text-block-heading">'.trim($heading).'</h3>';
    echo'<pre class="pre-display"><code class="code-display"> '.trim($codeText).'</code></pre>';

}

function displayParagraphText($heading, $content){
    echo' <h3 class="text-block-heading">'.trim($heading).'</h3class>';
    echo'<p class="paragraph">'.trim($content).'</p>';
}

function formatList($content){
// Replace the first *
    $content = preg_replace('/^\*/', '<li>', $content, 1);
// Replace the last *
    $content = preg_replace('/\*$/', '</li>', $content, 1);
// Replace any **
    return preg_replace('/\*\*/', '</li><li>', $content);
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
    generateBanner($backLinkURL,$bannerText,$showBackLink, $showHomeLink);
    ?>
</header>
<main class="page-wrapper content-container">

    <section class= "information-section">
    <?php
//    ARTICLE HEADING
    displayPageTitle($lessons[$index]['pageTitle']);

//    ARTICLE PARAGRAPHS
    for ($i = 0; $i < count($lessons[$index]['paragraphs']); $i++) {
        if ($lessons[$index]['paragraphs'][$i]['displayType'] == 'block') {
            // Display text as paragraph
            displayParagraphText($lessons[$index]['paragraphs'][$i]['heading'], $lessons[$index]['paragraphs'][$i]['content']);
        } elseif ($lessons[$index]['paragraphs'][$i]['displayType'] == 'list') {
            // Display text as list
            displayParagraphList($lessons[$index]['paragraphs'][$i]['heading'], $lessons[$index]['paragraphs'][$i]['content']);
        } elseif ($lessons[$index]['paragraphs'][$i]['displayType'] == 'code'){
            //display text as code example
            displayParagraphCodeExample($lessons[$index]['paragraphs'][$i]['heading'], $lessons[$index]['paragraphs'][$i]['content']);
        }
    }
    ?>
    </section>

    <h3>Demo</h3>

    <div class="demo-container box box-dark-blue disable">
        <div class="demo-btn-list" id="demo-options-list">
            <button class="btn demo-btn btn-dark-blue" value="<h1>h1 tag</h1>" onclick="changeDemoItem(this)">&lt;h1&gt;</button>
            <button class="btn demo-btn" value="<h3>h3 tag</h3>" onclick="changeDemoItem(this)">&lt;h3&gt;</button>
            <button class="btn demo-btn" value="<h4>h4 tag</h4>" onclick="changeDemoItem(this)">&lt;h4&gt;</button>
            <button class="btn demo-btn" value="<p>p tag</p>" onclick="changeDemoItem(this)">&lt;p&gt;</button>
        </div>
        <div class="box-dark-blue demo-inner-container disable" id="demo-container">
            <h1>h1 tag</h1>
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