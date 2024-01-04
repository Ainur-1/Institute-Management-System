<?php
$servername = "localhost";
$username = "admin";
$password = '$dmin77Q';
$dbname = "ims";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>