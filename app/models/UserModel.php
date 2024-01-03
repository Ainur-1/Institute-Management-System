<?php
class UserModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($login, $password, $email, $first_name, $last_name, $user_type){
        $sql = "INSERT INTO Users (login, password, email, first_name, last_name, user_type) 
                VALUES ('$login', '$password', '$email', '$first_name', '$last_name', '$user_type')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function authenticateUser($username, $password) {
        $username = mysqli_real_escape_string($this->conn, $username);

        $sql = "SELECT * FROM Users WHERE login='$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashed_password = $user['password'];

            if (password_verify($password, $hashed_password)) {
                return true;
            } else {
                return "Неправильный пароль!";
            }
        } else {
            return "Пользователь не найден!";
        }
        
    }
}
?>