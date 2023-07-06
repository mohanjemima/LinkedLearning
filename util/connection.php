<?php
// DONT COMMIT YOUR VALUES TO VCS!!!
$hostname = "devweb2022.cis.strath.ac.uk";
$username = "rqb22133";
$password = "ooraub0Emah2";
$db = "rqb22133";

$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Disable error display
error_reporting(0);

// Set up secure connection options
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn->set_charset("utf8mb4");
$conn->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

// Validate the connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
