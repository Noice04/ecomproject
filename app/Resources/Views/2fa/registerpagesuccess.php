<?php

namespace views;

require 'vendor/autoload.php';
use OTPHP\TOTP;

class RegisterPageSuccess {

    public function render() {
        

        if (!isset($_SESSION['new_2fa_secret'])) {
            echo "2FA secret missing.";
            exit;
        }

        $secret = $_SESSION['new_2fa_secret'];
        $userid = $_SESSION['temp_user_id'];

        $totp = TOTP::create($secret);
        $totp->setLabel($userid);
        $totp->setIssuer('MyApp');

        $qrUri = $totp->getProvisioningUri();
        $qrImage = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($qrUri);

        unset($_SESSION['new_2fa_secret']);
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>2FA Setup</title>
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
                .success-container {
                    background: white;
                    padding: 40px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    width: 350px;
                }
                .success-container h2 {
                    margin-bottom: 20px;
                }
                .success-container img {
                    border: 5px solid #eee;
                    border-radius: 10px;
                    margin-bottom: 20px;
                }
                .success-container p {
                    color: #555;
                    font-size: 14px;
                }
                .success-container .secret {
                    background: #f9f9f9;
                    border: 1px dashed #ccc;
                    padding: 10px;
                    font-family: monospace;
                    font-size: 16px;
                    margin-bottom: 20px;
                    word-wrap: break-word;
                    overflow-wrap: break-word;
                    max-width: 100%;
                }

                .success-container .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #aaa;
                }

            </style>
        </head>
        <link rel="icon" href="icon1.ico" type="image/ico">
        <body>
            <div class="success-container">
                <h2>Enable Two-Factor Authentication</h2>
                <img src="<?php echo $qrImage; ?>" alt="2FA QR Code" width="200" height="200">
                <p>Scan this QR code with your Authenticator app.</p>
                <p>Or enter this secret manually:</p>
                <div class="secret"><?php echo $secret; ?></div>
                <button onClick="window.location.href='logins'">Go to login?</button>
                <div class="footer">Secure your account with 2FA </div>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
