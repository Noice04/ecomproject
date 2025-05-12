<?php

namespace views;

class UserList {

    private $users;

    

    public function render($data) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>User List</title>
            <style>
                table { border-collapse: collapse; width: 60%; }
                th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h1>All Users</h1>
            <?php if (!empty($this->users)): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                    <?php foreach ($this->users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
        </body>
        </html>
        <?php
    }
}
