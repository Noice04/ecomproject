<?php

namespace views;

use core\auth\MembershipProvider;

class UserList {

    public function render($data) {

        if (isset($_GET['logout'])) {
            session_start();
            session_destroy();
        }

        $membership = new MembershipProvider();
        if ($membership->isLoggedIn()) {

            require("Resources\\Views\\templates\\header.php");

            $html = "
            <h2>Users Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>2FA Enabled</th>
                        <th>Secret</th>
                    </tr>
                </thead>
                <tbody>";

            foreach ($data as $user) {
                $html .= "<tr>";
                $html .= "<td>{$user['id']}</td>";
                $html .= "<td>{$user['username']}</td>";
                $html .= "<td>{$user['password']}</td>";
                $html .= "<td>" . ($user['enabled2FA'] ? 'Yes' : 'No') . "</td>";
                $html .= "<td>{$user['secret']}</td>";
                $html .= "</tr>";
            }

            $html .= "</tbody></table>
                <br>
                <a href=\"/app/users?logout\">Log Out</a>
            ";

            echo $html;

            require("Resources\\Views\\templates\\footer.php");

        } else {
            header('Location: /app/logins');
        }
    }
}
