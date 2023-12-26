<?php
$servername = "sql306.yzz.me";
$username = "yzzme_35665749";
$password = "SzZ9PwpQcRkW";
$dbname = "yzzme_35665749_mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>