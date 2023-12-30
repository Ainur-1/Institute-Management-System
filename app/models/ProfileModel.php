<?php
class ProfileModel {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getUserInfo($username) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?> 