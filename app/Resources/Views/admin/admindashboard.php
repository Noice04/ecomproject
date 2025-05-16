<?php

namespace views;

class AdminDashboard {

    public function render($data) {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['is_admin'])){//checks if is_admin is set or it boots you to home
            header("location:homes");
        }
        if(!$_SESSION['is_admin']){//checks if is_admin is set to true or it boots you to home
                header("location:homes");
        }

        require("Resources\\Views\\Public\\header.php");
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Manage Users and Admins</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background: #f8f8f8;
                }
                .container {
                    width: 85%;
                    margin: 20px auto;
                    margin-top:100px;
                    margin-right:80px;
                    padding-left: 250px;
                    max-width: 85vw;
                }
                .admin-card {
                    background: #fff;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    padding: 20px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .admin-info {
                    flex-grow: 1;
                }
                .admin-info h3 {
                    margin: 0 0 5px;
                }
                .admin-info p {
                    margin: 2px 0;
                    color: #666;
                }
                .admin-actions {
                    display: flex;
                    gap: 10px;
                }
                .admin-actions form {
                    display: inline;
                }
                .admin-actions button {
                    padding: 10px 20px;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;
                    font-weight: bold;
                    transition: background-color 0.2s ease;
                }
                .btn-promote {
                    background-color: #0d6efd;
                    color: white;
                }
                .btn-demote {
                    background-color: #ffc107;
                    color: black;
                }
                .btn-delete {
                    background-color: #dc3545;
                    color: white;
                }
                .btn-promote:hover {
                    background-color: #0b5ed7;
                }
                .btn-demote:hover {
                    background-color: #e0a800;
                }
                .btn-delete:hover {
                    background-color: #bb2d3b;
                }
                .left-fixed-panel {
                    position: fixed;
                    top: 80px;
                    left: 0;
                    height: 100vh;
                    width: 200px;
                    background-color: #f4f4f4;
                    padding: 20px;
                    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
                    z-index: 1000;
                    margin-right: 5px;
                }
                .left-fixed-panel h3 {
                    font-size: 18px;
                    margin-bottom: 10px;
                }
                .left-fixed-panel p {
                    font-size: 14px;
                    color: #555;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Manage Users and Admins</h1>
                <div class="left-fixed-panel">
                    <h3>Admin Panel</h3>
                    <p>Promote, demote, or delete admin accounts.</p>
                </div>

                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $user): ?>
                        <div class="admin-card">
                            <div class="admin-info">
                                <h3><?= htmlspecialchars($user['username']) ?></h3>
                                <p>Email: <?= htmlspecialchars($user['email']) ?></p>
                                <p>Role:<?php if($user['is_admin']==1){echo "Administrator";}else echo "Customer";?></p>
                            </div>
                            <div class="admin-actions">
                                <form action="admins" method="POST">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                    <button type="submit" class="btn-promote"name="action"value="promote">Promote</button>
                                </form>
                                <form action="admins" method="POST">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                    <button type="submit" class="btn-demote" name="action" value="demote">Demote</button>
                                </form>
                                <form action="admins" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                    <button type="submit" class="btn-delete"name="action" value="delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No users found.</p><?php //this should never happen unless if someone deletes user1 from the database manually?>
                <?php endif; ?>
            </div>
        </body>
         <?php require("Resources\\Views\\Public\\footer.php");?>
        </html>
        <?php
    }
}
