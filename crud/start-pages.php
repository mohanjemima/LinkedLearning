<?php /** @noinspection ALL */

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
            redirectToSignUpWithError('400:Account-exists');
        } elseif (isImpersonatingAdmin($signEmail)) {
            redirectToSignUpWithError('400:dumb-exists');
        } else {
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

#[NoReturn] function redirectToSignUpWithError(string $string): void
{
    $encodedValue = urlencode($string);
    header("Location: ../sign-up.php?value=$encodedValue");
    exit;
}
#[NoReturn] function redirectToLoginWithError(string $string): void
{
    $encodedValue = urlencode($string);
    header("Location: ../log-in.php?value=$encodedValue");
    exit;
}

#[NoReturn] function redirectToDashboard(): void
{header("Location: ..\dashboard.php");
exit;}

#[NoReturn] function redirectToStaffDashboard(): void{
    header("Location: ..\staff-dashboard.php");
    exit;
}

function emailExists($email)
{
    global $userData;

    foreach ($userData as $user) {
        if ($user['email'] === $email) {
            return true;
        }
    }

    return false;
}

function addUser($name, $age, $email, $password)
{
    global $conn;

    $name = mysqli_real_escape_string($conn, $name);
    $age = mysqli_real_escape_string($conn, $age);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "INSERT INTO User (name, age, email, password) VALUES ('$name', '$age', '$email', '$password')";

    if ($conn->query($sql)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

function validateAccount($findPassword, $findEmail)
{
    global $conn;
    $findEmail = mysqli_real_escape_string($conn, $findEmail);
    $findPassword = mysqli_real_escape_string($conn, $findPassword);

    $sql = "SELECT id FROM User WHERE email = '$findEmail' AND password = '$findPassword'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return false;
    }
}

function isImpersonatingAdmin($email)
{
    return strpos($email, '.staff@LinkedLearning') !== false;
}

function isAdmin($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

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
