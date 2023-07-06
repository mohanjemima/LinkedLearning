<?php
include(dirname(__DIR__).'/util/connection.php');
include(dirname(__DIR__).'/util/fetch.php');
include './crud/dashboard-data.php';


session_start();

$userData = fetch('User');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //getting the file name of previous page
    $senderFile = $_POST['current_file'];

    //IF previous file was SIGN UP (QUIZ) PAGE
    if($senderFile == 'sign-up-quiz.php') {
        $childName = $_POST['child-name'];
        $age = $_POST['age'];
        $signEmail = $_POST['sign-up-email'];
        $signPassword = $_POST['sign-up-password'];

        if (check_email_exists($userData, $signEmail)) {
            //if e-mail already used then return to sign-up.php & display-error
            $encodedValue = urlencode("400:Account-exists");
            header("Location: ..\sign-up.php?error=$encodedValue");
            exit();
        } elseif (notImpersonateAdmin($signEmail)){
            //if email ends with admin formatting, it's impersonating an admin account;
            $encodedValue = urlencode("401:Not_Authorised");
            header("Location: ..\sign-up.php?error=$encodedValue");

        }else {
            add_user($childName, $age, $signEmail, $signPassword);
        }
    }

    //IF previous file was LOGIN PAGE
    if($senderFile == 'log-in.php') {
        $logEmail = $_POST['log-email'];
        $logPassword = $_POST['log-password'];

        if (!check_email_exists($userData, $logEmail)) { //check e-mail exists
            $encodedValue = urlencode("401:email");
            header("Location: ..\log-in.php?error=$encodedValue");
            exit();
        }elseif (!valid_account($logPassword, $logEmail)) { //check account details exists & match : FALSE
            $encodedValue = urlencode("401:password");
            header("Location: ..\log-in.php?error=$encodedValue");
            exit();
        }else{
            $userID = valid_account($logPassword, $logEmail); //check account details exists & match : TRUE
            $_SESSION['userID'] = $userID;

            if(isAdmin($userID)){
                //Admin
                header("Location: ..\staff-dashboard.php");
            }else if(!isAdmin($userID)){
                //User
                header("Location: ..\dashboard.php");
            }else{
                $encodedValue = urlencode("400:Bad_Data");
                header("Location: ..\log-in.php?error=$encodedValue");
            }
            exit();
        }
    }
}

//check through all e-mails
function check_email_exists($array,$findEmail){
    $emailExists = false;

    foreach ($array as $user) {
        if ($user['email'] === $findEmail) {
            $emailExists = true;
            break;
        }
    }
    return $emailExists;
}


//Add's user data
function add_user($name,$age,$email,$password){
    global $conn;

    $sql = "INSERT INTO User (name, age, email, password) VALUES ('$name',' $age', '$email', '$password')";
    //implement data binding if enough time;
    if ($conn->query($sql)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $conn->errorInfo()[2];
    }
}


//check account exists
function valid_account($findPassword,$findEmail){
    global $conn;
    $findEmail = mysqli_real_escape_string($conn, $findEmail);
    $findPassword = mysqli_real_escape_string($conn, $findPassword);

    $sql = "SELECT id FROM User WHERE email = '$findEmail' AND password = '$findPassword'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        return $result['id'];
    }else{
        return false;
    }
}

function notImpersonateAdmin($email){

    if(str_ends_with($email, '.staff@LinkedLearning')){
        return true;
    }else{
        return false;
    }

}

function isAdmin($id){
    global $conn;
    $id = mysqli_escape_string($conn, $id);

    $sql = "SELECT `is_admin` FROM `User` WHERE `id` = '$id'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        return $result['is_admin'];
    }else{
        return Null;
    }
}

exit();