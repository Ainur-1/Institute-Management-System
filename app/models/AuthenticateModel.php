<?php
class AuthenticateModel {

    private $conn;
    private $user;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->user = new User($this->conn);
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
        $user = $this->user->getUserByEmail($username);

        if ($user) {
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