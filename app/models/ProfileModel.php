<?php
class ProfileModel {
    private $conn;
    private $users;
    private $roles;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->users = new Users($this->conn);
        $this->roles = new Roles($this->conn);
    }

    public function getUserInfo($username) {
        return $this->users->getUserByEmail($username);
    }

    public function getAllUsers() {
        return $this->users->getUsers();
    }

    public function getRoles() {
        return $this->roles->getRoles();
    }

    public function updateUserPassword($userId, $hashedPassword) {
        return $this->users->updateUserPassword($userId, $hashedPassword);
    }

    public function AddUser($username, $password, $role_id, $first_name, $last_name) {
        return $this->users->AddUser($username, $password, $role_id, $first_name, $last_name);
    }

    public function DeleteUser($id) {
        return $this->users->DeleteUser($id);
    }
}