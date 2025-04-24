<?php

namespace views;

class UserRegister {
    public function render($errors = []) {
        require("Resources\\Views\\templates\\header.php");

        $html = "
            <h2>Register New User</h2>";

        if (!empty($errors)) {
            $html .= "<ul style='color:red;'>";
            foreach ($errors as $error) {
                $html .= "<li>$error</li>";
            }
            $html .= "</ul>";
        }

        $html .= '
            <form method="POST" action="/app/users/register">
                <label>Username:</label><br>
                <input type="text" name="username" required><br><br>

                <label>Password:</label><br>
                <input type="password" name="password" required><br><br>

                <label>Enable 2FA:</label><br>
                <select name="enabled2FA">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select><br><br>

                <label>Secret (for 2FA):</label><br>
                <input type="text" name="secret"><br><br>

                <button type="submit">Register</button>
            </form>
            <br>
            <a href="/app/logins">Back to Login</a>
        ';

        echo $html;
        require("Resources\\Views\\templates\\footer.php");
    }
}
