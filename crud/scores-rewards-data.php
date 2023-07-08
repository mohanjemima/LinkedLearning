<?php

use JetBrains\PhpStorm\NoReturn;

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
function isPurchased($user_id, $reward_id): bool
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM UnlockedAvatar WHERE user_id = ? AND reward_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $reward_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $count > 0;
}

if (isset($_GET["rewardItemId"])) {
    $rewardItemId = $_GET["rewardItemId"];
    // Use the $rewardItemId value in your PHP code as needed
    purchaseReward($id,$rewardItemId);

}
// getting rewardID on click without using ajax

function purchaseReward($user_id, $reward_id): void {
    global $conn;

    $price = getPrice($reward_id);
    $points = getPoints($user_id);
    $updatedPoints = $points - $price;

    echo $points;
    $sql_unlock = "INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('$user_id', '$reward_id')";
    $sql_update_points = "UPDATE User SET points = '$updatedPoints' WHERE id ='$user_id'";

    if ($points >= $price) {
        mysqli_query($conn, $sql_unlock);
        mysqli_query($conn, $sql_update_points);

        header("Location: ../scores-rewards.php#Rewards");
        exit;
    } else {
        $encodedValue = urlencode("Not_Enough_Points");
        header("Location: ../scores-rewards.php?value=$encodedValue");
        exit;
    }
}


function getPoints($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT points FROM User WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($points);
    $stmt->fetch();
    $stmt->close();

    return $points;
}


function getPrice($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT cost FROM Reward WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($cost);
    $stmt->fetch();
    $stmt->close();

    return $cost;
}
