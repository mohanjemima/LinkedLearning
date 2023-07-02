<?php
include(dirname(__DIR__).'/util/connection.php');
include(dirname(__DIR__).'/util/fetch.php');


function get_user_record($findID){
    global $conn;
//    $findID = mysqli_real_escape_string($conn, $findID);

    $sql = "SELECT * FROM `User` WHERE `id` = '$findID'";
    $result = mysqli_query($conn, $sql);

    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();
}


function get_user_rank($userID){
    global $conn;
    $sql= "SELECT `id`,`score` FROM `User`";
    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $rows = insertionSortDesc($rows, 'score');

    return findUserRank($rows,$userID);

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
function findUserRank($array, $targetID) {
    foreach ($array as $rank => $user) {
        if ($user['id'] == $targetID) {
            return ($rank+1);
        }
    }
    return -1; // Return -1 if the user with the specified ID is not found in the array
}

function get_no_available_lessons(){
    global $conn;
    $sql = "SELECT * FROM `Lesson`";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}

function get_current_lesson($id){
    global $conn;
    $sql = "SELECT * FROM `Lesson` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return 0;
    }
}

function get_title($id){
    return strip_tags(get_current_lesson($id)['title']);
}

function get_content($id){
    return strip_tags(get_current_lesson($id)['content']);
}
