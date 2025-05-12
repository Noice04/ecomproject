<?php

namespace views;

class LoginPage {

    public function render() {
        ?>
        <!DOCTYPE html>
        <head>
            
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background: #f2f2f2;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .login-container {
                    background: white;
                    padding: 40px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    width: 300px;
                    text-align: center;
                }
                .login-container h2 {
                    margin-bottom: 20px;
                }
                .login-container input[type="text"],
                .login-container input[type="password"] {
                    width: 100%;
                    padding: 10px;
                    margin: 10px 0;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }
                .login-container button {
                    width: 100%;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }
                .login-container button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>

            <div class="login-container">
                <h2>Login</h2>
                <form method="POST" action="">
                    <input type="text" name="username" placeholder="Username" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <table>
                        <tr>
                            <td>
                                <button type="submit" name="page" value="home"style="width: 180px;" >Log in</button>
                            </td>
                            <td><a href="registers" style="font-size:13px;" >Don't have an <br>account?Register.</a></td>
                        </tr>
                        <tr>
                            <td><a href="homes">Continue as guest</a></td>
                        </tr>
                    </table>
                    
                </form>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
