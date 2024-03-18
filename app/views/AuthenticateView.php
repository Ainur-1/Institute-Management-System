<?php
class AuthenticateView {
    public function renderAuthForm() {
        return '
        <div class="content">
        <form action="" method="post">
            <h2>Авторизация</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="login" value="Login">
        </form>
        </div>
        ';
    }
}
?>