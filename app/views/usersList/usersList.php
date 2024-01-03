<?php
// session_start();

// if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
//     header("Location: ../authenticate/index.php");
//     exit;
// }

include "../../../db_config.php";

$pageTitle = "Список пользователей";
include '../../../resources/includes/header.php';

$sql = "SELECT * FROM Users";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr>";
echo "<th>ID</th><th>Логин</th><th>Почта</th><th>Имя</th><th>Фамилия</th><th>Тип пользователя</th>";
echo "</tr>";

while ($user = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $user['id'] . "</td>"; 
    echo "<td>" . $user['login'] . "</td>";
    echo "<td>" . $user['email'] . "</td>";
    echo "<td>" . $user['first_name'] . "</td>";
    echo "<td>" . $user['last_name'] . "</td>";
    echo "<td>" . $user['user_type'] . "</td>"; 
    echo "</tr>";
}

echo "</table>";

include '../../../resources/includes/footer.php';
?>