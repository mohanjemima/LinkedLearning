<?php
$hostname = "devweb2022.cis.strath.ac.uk";
// DONT COMMIT YOUR VALUES TO VCS!!!
$username = "REPLACE";
$password = "REPLACE";
$db = "REPLACE";

$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
