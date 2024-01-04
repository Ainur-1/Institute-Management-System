<?php
class ProfileModel {
    private $conn;
    private $user;

    public function __construct($conn){
        $this->conn = $conn;
        $this->user = new User($this->conn);
    }

    public function getUserInfo($username) {
        return $this->user->getUserByEmail($username);
    }
}
?> 