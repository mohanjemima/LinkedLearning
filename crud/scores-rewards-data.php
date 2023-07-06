<?php
include(dirname(__DIR__).'/util/connection.php');
include(dirname(__DIR__).'/util/fetch.php');

session_start();

$id = $_SESSION['userID'];

function getRewards(){
    global $conn;
    $sql = "SELECT * FROM Reward WHERE id <> '6'"; //6 is the default img, not available for sale
    $result = mysqli_query($conn, $sql);

    $rows = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows; // return as array;
}

function getTopScores() {
    global $conn;
    $sql = "SELECT name, score FROM User WHERE is_admin = '0' ORDER BY score DESC";
    $result = mysqli_query($conn, $sql);

    $rows = array();
    $counter = 0;

    while (($row = mysqli_fetch_assoc($result)) && ($counter < 10)) {
        $rows[] = $row;
        $counter++;
    }

    return $rows;
}
