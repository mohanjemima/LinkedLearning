<?php

use JetBrains\PhpStorm\NoReturn;

require_once dirname(__DIR__) . '/util/connection.php';
require_once dirname(__DIR__) . '/util/fetch.php';

session_start();

$userData = fetch('User');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderFile = $_POST['current_file'];

    if ($senderFile === 'sign-up-quiz.php') {
        $childName = $_POST['child-name'];
        $age = $_POST['age'];
        $signEmail = $_POST['sign-up-email'];
        $signPassword = $_POST['sign-up-password'];

        if (emailExists($signEmail)) {
            echo'here1';

            redirectToSignUpWithError('400:Account-exists');
        } elseif (isImpersonatingAdmin($signEmail)) {
            echo'here2';

            redirectToSignUpWithError('400:dumb-exists');
        } else {
            echo'here3';

            addUser($childName, $age, $signEmail, $signPassword);
            $userID = validateAccount($signPassword, $signEmail);
            $_SESSION['userID'] = $userID;
            $_SESSION['logged-in'] = true;
            redirectToDashboard();
        }
    }

    if ($senderFile === 'log-in.php') {
        $logEmail = $_POST['log-email'];
        $logPassword = $_POST['log-password'];

        if (!emailExists($logEmail)) {
            redirectToLoginWithError('401:email');
        } elseif (!validateAccount($logPassword, $logEmail)) {
            redirectToLoginWithError('401:password');
        } else {
            $userID = validateAccount($logPassword, $logEmail);
            $_SESSION['userID'] = $userID;
            $_SESSION['logged-in'] = true;

            if (isAdmin($userID)) {
                redirectToStaffDashboard();
            } else {
                redirectToDashboard();
            }
        }
    }
}

#[NoReturn]
function redirectToSignUpWithError(string $string): void
{
    $encodedValue = urlencode($string);
    header("Location: ../sign-up.php?value=$encodedValue");
    exit;
}

#[NoReturn]
function redirectToLoginWithError(string $string): void
{
    $encodedValue = urlencode($string);
    header("Location: ../log-in.php?value=$encodedValue");
    exit;
}

#[NoReturn]
function redirectToDashboard(): void
{
    header("Location: ../dashboard.php");
    exit;
}

#[NoReturn]
function redirectToStaffDashboard(): void
{
    header("Location: ../staff-dashboard.php");
    exit;
}

function emailExists($email): bool
{
    global $userData;

    foreach ($userData as $user) {
        if ($user['email'] === $email) {
            return true;
        }
    }

    return false;
}

function addUser($name, $age, $email, $password): void
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO User (name, age, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $age, $email, $password);

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

function validateAccount($findPassword, $findEmail)
{
    global $conn;

    $stmt = $conn->prepare("SELECT id FROM User WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $findEmail, $findPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        return false;
    }
}

function isImpersonatingAdmin($email): bool
{
    return str_contains($email, '.staff@LinkedLearning');
}

function isAdmin($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT `is_admin` FROM `User` WHERE `id` = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['is_admin'];
    } else {
        return null;
    }
}
