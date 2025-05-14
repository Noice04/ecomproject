<!DOCTYPE html>
<html>
    <head>
        <style>

            .logo {
                font-size: 24px;
                font-weight: bold;
            }
            
            header{
                z-index: 1000;
                background-color: green;
                display: flex;
                color: white;
                justify-content: space-between;
                align-items: center;
                padding: 15px 30px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                position:fixed;
                top:0;
                width: 100%;
                max-height:40px;
                margin-bottom:15px;
            }
            nav a {
                color: white;
                text-decoration: none;
                margin-left: 20px;
                margin-right:70px;
                font-size: 16px;
            }
            .sign-up{
                margin-right:40px;
            }
            
            nav a:hover {
                color: #00bfff;
            }

            .menu {
                display: flex;
                align-items: center;
            }
            .logout {
                margin-right:40px;
                display: flex;
                align-items: center;
                gap: 10px;
                justify-content: space-between; /* space between text and image */
                padding: 10px;
                border-radius: 5px;
            }

            .logout-content {
                display: flex;
                flex-direction: column;
            }
            .logout img {
                width: 32px; /* optional: control size */
                height: 32px;
                object-fit: contain;
            }

        </style>
    </head>
        <link rel="icon" href="icon1.ico" type="image/ico">
    <body>
        <header>


            <div class="logo">ShopFresh</div>
                <nav class="menu">
                    <a href="homes">Home</a>
                    <a href="products">Products</a>
                    <a href="deals">Deals</a>
                    <a href="orders">Orders</a>
                </nav>


            <?php 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
                if (!isset($_SESSION['user_id'])): 
            ?>
                    <nav>
                        <a href="logins">Log In</a>

                    <a class="sign-up"href="registers">Sign Up</a>
                    </nav>
                    

                    <?php else: ?>
                        
                        <nav class="logout">
                            <div class="logout-content">
                                <p style="margin: 5px 0;">Hello <?php echo $_SESSION['username'] ?></p>
                                <a href="logouts">Log out</a>
                            </div>
                            <img src="icon1.ico" alt="cart" onClick="window.location.href = 'carts'">
                        </nav>
                        
                    
                    <?php endif ?>
        </header>
    </body>
     
</html>