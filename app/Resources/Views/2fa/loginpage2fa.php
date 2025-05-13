<?php

namespace views;

class LoginPage2fa {

    public function render() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>2FA Verification</title>
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
                .twofa-container {
                    background: white;
                    padding: 40px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    width: 300px;
                    text-align: center;
                }
                .twofa-container h2 {
                    margin-bottom: 20px;
                }
                .twofa-container input[type="text"] {
                    width: 100%;
                    padding: 10px;
                    margin: 10px 0 20px 0;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }
                .twofa-container button {
                    width: 100%;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }
                .twofa-container button:hover {
                    background-color: #45a049;
                }
                .info-text {
                    font-size: 14px;
                    color: #666;
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <link rel="icon" href="icon1.ico" type="image/ico">
        <body>
            <div class="twofa-container">
                <h2>Two-Factor Authentication</h2>
                <p class="info-text">Enter the 6-digit code from your Authenticator app</p>
                <form method="POST" action="">
                    <input type="text" name="secret" placeholder="Enter 2FA Code" required>
                    <button type="submit">Verify</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
