<?php
$hostname = "devweb2022.cis.strath.ac.uk";
// DONT COMMIT YOUR VALUES TO VCS!!!
$username = "rqb22133";
$password = "ooraub0Emah2";
$db = "rqb22133";

$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
