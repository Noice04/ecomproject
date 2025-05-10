<?php

    namespace views\public;


    class Register{

        public function render(){

            $html='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <form action="/app/registers" method="POST">
                <label for="username">Username:</label><br>
                <input type="text" name="username"><br>

                <label for="email">Email:</label><br>
                <input type="text" name="email"><br>

                <label for="password">Password:</label><br>
                <input type="password" name="password" ><br>
                
                <br>
                <input type="submit" value="Register">
            </form>''
        </body>
        </html>';


        }
    }


?>