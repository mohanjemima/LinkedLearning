<?php
include(dirname(__DIR__) . '/util/connection.php');
include(dirname(__DIR__) . '/util/fetch.php');

session_start();

$id = $_SESSION['userID'];

function getRewards(): array
{
    global $conn;
    $sql = "SELECT * FROM Reward WHERE id <> ?";
    $stmt = $conn->prepare($sql);
    $excludedId = 6; // 6 is the default img, not available for sale
    $stmt->bind_param("i", $excludedId);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = array();

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    $stmt->close();

    return $rows; // return as array
}

function getTopScores(): array
{
    global $conn;
    $sql = "SELECT name, score FROM User WHERE is_admin = ? ORDER BY score DESC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $isAdmin = 0;
    $stmt->bind_param("i", $isAdmin);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = array();

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    $stmt->close();

    return $rows;
}
