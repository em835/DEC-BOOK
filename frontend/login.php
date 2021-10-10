<?php
session_start();
var_dump($_SESSION);
require_once("../middle/loginhandle.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FontAwesome CSS-->
    <script src="https://kit.fontawesome.com/a72b2bc306.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>DEC BOOK</title>
</head>
<body>
    <h1 id="title">Welcome to DEC BOOK</h1>
    <div class=main>
        <div class=heading>
            <h2>Login</h2>
            <i class="fas fa-user"></i>
        </div>
        <div class="login">
            <form action="login.php" method="POST">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br><br>
                <input type="submit" value="Login">
              </form>
        </div>

        <div class="register">
            <a href="register.php">Click here to register</a>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <script src="js/main.js"></script>
</body>
</html>
