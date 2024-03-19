<?php
require_once "app/core/BaseModel.php";

class AuthenticateModel extends BaseModel{
    private $user;

    public function __construct($conn) {
        parent::__construct($conn);
        $this->user = new Users($this->conn);
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