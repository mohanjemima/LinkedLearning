<?php
include 'component.php'; // banner code
include 'util/fetch.php';

// Customize the link URLs, text, and display status for Banner
$backLinkURL = './staff-dashboard.php';// back link for the back button
$bannerText = 'Dashboard';
$showBackLink = true;
$showHomeLink = false;

$title = "";
$content = "";
$lesson = "";

if (array_key_exists("id", $_GET)) {
    $lesson = get_lesson($_GET["id"]);
    if (sizeof($lesson) == 1) {
        $title = $lesson[0]["title"];
        $content = $lesson[0]["content"];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta  charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Linked Learning | New Lesson</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/lesson-content.css">
</head>
<body>
<header>
    <?php
    // Generate the banner HTML code
    generateBanner($backLinkURL,$bannerText, true, false, false);
    ?>
</header>
<main class="page-wrapper content-container">

    <form action="crud/lesson.php<?php if (array_key_exists("id", $_GET)) { $lesson_id = $_GET["id"]; echo "?id=$lesson_id"; } ?>" method="post">
        <?php if (array_key_exists("id", $_GET)) { $lesson_id = $_GET["id"]; echo "<input type=\"hidden\" name=\"id\" value=\"$lesson_id\" />"; } ?>

        <h2>Page Content</h2>
        <input class="text-input edit-input" id="title" name="title" placeholder="Lesson Title" value="<?php echo $title?>" required />
        <label for="title"></label>

        <textarea class="text-input edit-text-area" id="content" name="content" placeholder="Lesson Content" rows="35" required><?php echo $content?></textarea>
        <label for="content"></label>

        <h2 class="demo-options-editor-title">Demo Items</h2>

        <section class="demo-options-editor-container" id="demo-items">

        </section>

        <section>
            <button type="button" class="btn btn-dark-blue next-btn" onclick="addNewDemoOptionToForm()">Add Item</button>
            <button type="button" class="btn next-btn" onclick="removeLastDemoOptionFromForm()">Remove Item</button>
        </section>

        <section class="submit-buttons-container">
            <a href="./staff-dashboard.php"><button type="button" class="btn btn-red next-btn">Cancel</button></a>
            <button type="submit" class="btn btn-green next-btn">Save</button>
        </section>
    </form>

</main>
<script type="text/javascript">
    function addNewDemoOptionToForm(headerValue="", contentValue="") {
        let nextNum = document.getElementById("demo-items").children.length + 1;
        document.getElementById("demo-items").insertAdjacentHTML(
            "beforeend",
            `<div>` +
            `<input class=\"text-input  edit-input\" name=\"demo-option-header[]\" placeholder=\"Demo Option ${nextNum} Header\" value="${headerValue}" required />\n` +
            `<textarea class=\"text-input  edit-text-area\" name=\"demo-option-content[]\" placeholder=\"Demo Option ${nextNum} HTML Renderable Content\" rows=\"3\" required>${contentValue}</textarea>\n` +
            `</div>`
        );
    }

    function removeLastDemoOptionFromForm() {
        let items = document.getElementById("demo-items");
        items.removeChild(items.lastChild);
    }

    window.onload = function() {
        <?php
        if ($lesson != "") {
            $demo_items = get_demo_items($lesson[0]["id"]);

            foreach ($demo_items as $demo_item) {
                echo "addNewDemoOptionToForm(\"${demo_item['display_label']}\", \"${demo_item['html_content']}\");";
            }
        }

        ?>
    }
</script>
</body>
</html>
