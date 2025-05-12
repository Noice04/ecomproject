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
        </style>
    </head>
 
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
            session_start();
                if (!isset($_SESSION['user_id'])): 
            ?>
                    <nav>
                        <a href="logins">Log In</a>

                    <a class="sign-up"href="registers">Sign Up</a>
                    </nav>
                    

                    <?php else: ?>
                        
                        <nav>
                            <p>Hello <?php echo $_SESSION['username']?></p>
                            <a href="logout">Log out</a>
                        </nav>

                        
                    
                    <?php endif ?>
        </header>
    </body>
     
</html>