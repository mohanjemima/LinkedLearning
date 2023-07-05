<?php
include(dirname(__DIR__).'/util/connection.php');
include(dirname(__DIR__).'/util/fetch.php');

$userData = fetch('Users');

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
            header("Location: ..\sign-up.php?value=$encodedValue");
                //Use te URL below to see the value being sent
                //https://devweb2022.cis.strath.ac.uk/~rqb22133/sign-up.php?value=acount-exists
            exit();
        } else {
            add_user($childName, $age, $signEmail, $signPassword);
        }
    }

    //IF previous file was LOGIN PAGE
    if($senderFile == 'log-in.php') {
        $logEmail = $_POST['log-email'];
        $logPassword = $_POST['log-password'];

        if (!check_email_exists($userData, $logEmail)) { //check e-mail exists
            $encodedValue = urlencode("401:email");
            header("Location: ..\log-in.php?value=$encodedValue");
            exit();
        }elseif (!valid_account($logPassword, $logEmail)) { //check account details exists & match : FALSE
            $encodedValue = urlencode("401:password");
            header("Location: ..\log-in.php?value=$encodedValue");
            exit();
        }else{
            $userID = valid_account($logPassword, $logEmail); //check account details exists & match : TRUE
            $encodedValue = urlencode($userID);
            header("Location: ..\dashboard.php?value=$encodedValue");
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

    $sql = "INSERT INTO Users (name, age, email, password) VALUES ('$name',' $age', '$email', '$password')";
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

    $sql = "SELECT id FROM Users WHERE email = '$findEmail' AND password = '$findPassword'";

    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    }else{
        return false;
    }
}

exit();
