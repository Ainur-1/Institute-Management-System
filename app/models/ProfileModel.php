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

    public function getUserInfo($user) {
        if (strpos($user, '@') !== false) {
            return $this->users->getUserByEmail($user);
        } else {
            return $this->users->getUserById($user);
        }  
    }

    public function getAllUsers() {
        return $this->users->getUsers();
    }

    public function getRoles() {
        return $this->roles->getRoles();
    }

    public function UpdateUser($id, $first_name, $last_named) {
        return $this->users->UpdateUser($id, $first_name, $last_named);
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