<!DOCTYPE html>
<html>
    <head>
        <style>

            .logo {
                font-size: 24px;
                font-weight: bold;
            }
            
            header{
                background-color: green;
                display: flex;
                color: white;
                justify-content: space-between;
                align-items: center;
                padding: 15px 30px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            nav a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
      font-size: 16px;
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
                    <a href="aboutuss">About Us</a>
                </nav>


            <?php 
            session_start();
                if (!isset($_SESSION['user_id'])): 
            ?>
                    <nav>
                        <a href="logins">Log In</a>

                    <a href="registers">Sign Up</a>
                    </nav>
                    

                    <?php else: ?>
                        
                        <form action="/app/registers" method="POST">
                            <p style="position:absolute;top: 20px; right: 140px;"> Hello <?php echo $_SESSION['username'] ?> </p>
                            <button type="submit" name="page" value="Log out"class="top-right-buttons" style="position:absolute;top: 20px; right: 20px;">Log out</button>
                        </form>
                    
                    <?php endif ?>
        </header>
    </body>
     
</html>