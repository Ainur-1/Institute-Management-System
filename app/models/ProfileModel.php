<?php
class ProfileModel {
    private $conn;
    private $user;

    public function __construct($conn){
        $this->conn = $conn;
        $this->user = new Users($this->conn);
    }

    public function getUserInfo($username) {
        return $this->user->getUserByEmail($username);
    }

    public function getAllUsers(){
        return $this->user->getUsers();
    }

    public function updateUserPassword($userId, $hashedPassword) {
        return $this->user->updateUserPassword($userId, $hashedPassword);
    }
}