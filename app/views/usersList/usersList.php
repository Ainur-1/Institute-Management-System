<?php
// session_start();

// if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
//     header("Location: ../authenticate/index.php");
//     exit;
// }

include "../../../db_config.php";

$pageTitle = "Список пользователей";
include '../../../resources/includes/header.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr>";
echo "<th>ID</th><th>Имя</th><th>Email</th>";
echo "</tr>";

while ($user = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $user['id'] . "</td>"; 
    echo "<td>" . $user['username'] . "</td>";
    echo "<td>" . $user['email'] . "</td>";
    echo "</tr>";
}

echo "</table>";

include '../../../resources/includes/footer.php';
?>