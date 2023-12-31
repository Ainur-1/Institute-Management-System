<?php
class RegisterView {
    public function output() {
        return '
        <form action="" method="post">
            <h2>Регистрация</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <input type="submit" name="register" value="Register">
        </form>
        ';
    }
}
?>