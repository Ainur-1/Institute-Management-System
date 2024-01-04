<?php
class UserModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($username, $password, $email){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }

    }

    public function authenticateUser($username, $password) {
        $username = mysqli_real_escape_string($this->conn, $username);

        $sql = "SELECT * FROM Users WHERE email='$username'";
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