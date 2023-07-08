<?php
include(dirname(__DIR__) . '/util/connection.php');

function get_user_record($findID): ?array
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `User` WHERE `id` = ?");
    $stmt->bind_param("s", $findID);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result ? $result->fetch_assoc() : null;
}

function get_user_rank($userID): int|string
{
    global $conn;
    $stmt = $conn->prepare("SELECT `id`, `score` FROM `User` ORDER BY `score` DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return findUserRank($rows, $userID);
}

function insertionSortDesc($array, $columnName)
{
    $n = count($array);

    for ($i = 1; $i < $n; $i++) {
        $key = $array[$i];
        $j = $i - 1;

        while ($j >= 0 && $array[$j][$columnName] < $key[$columnName]) {
            $array[$j + 1] = $array[$j];
            $j = $j - 1;
        }

        $array[$j + 1] = $key;
    }

    return $array;
}

function findUserRank($array, $targetID): int|string
{
    foreach ($array as $rank => $user) {
        if ($user['id'] == $targetID) {
            return ($rank + 1);
        }
    }
    return -1; // Return -1 if the user with the specified ID is not found in the array
}

function get_no_available_lessons(): int
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM `Lesson`");
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return $count;
}


function get_current_lesson($id): ?array
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM Lesson WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

function get_title($id): string
{
    $lesson = get_current_lesson($id);
    $title = '';

    if ($lesson && isset($lesson['title'])) {
        $title = strip_tags($lesson['title']);
    }

    return $title;
}

function get_content($id): string
{
    $lesson = get_current_lesson($id);
    $content = '';

    if ($lesson && isset($lesson['content'])) {
        $content = strip_tags($lesson['content']);
    }

    return $content;
}

function getName($id): ?string
{
    global $conn;
    $stmt = $conn->prepare("SELECT name FROM User WHERE is_admin = '1' AND id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    return $row ? $row['name'] : null;
}
