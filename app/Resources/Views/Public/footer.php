<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <style>
        footer {
            background-color: #146c2b;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0 20px;
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
            margin-bottom: 20px;
        }
        .footer-section h4, .footer-section h3 {
            margin-bottom: 10px;
        }
        .footer-section p, .footer-section li {
            font-size: 14px;
            line-height: 1.6;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        .footer-section a {
            color: white;
            text-decoration: none;
        }
        .footer-section a:hover {
            text-decoration: underline;
        }
        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>ShopFresh</h3>
                <p>Your go-to store for fresh groceries delivered to your doorstep with care and speed. Local, reliable, and always fresh.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="homes">Home</a></li>
                    <li><a href="products">Products</a></li>
                    <li><a href="deals">Deals</a></li>
                    <li><a href="orders">Orders</a></li>
                    <?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li><a href="logins">Login</a></li>
                        <li><a href="registers">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: support@shopfresh.com</p>
                <p>Phone: +1 (555) 123-4567</p>
                <p>123 Fresh Avenue, Green City</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?= date("Y") ?> ShopFresh. All rights reserved.
        </div>
    </footer>
</body>
</html>
