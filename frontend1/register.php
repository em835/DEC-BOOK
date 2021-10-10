<?php
  require_once("../middle/registerhandle.php");

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
    <title>CS490 Project</title>
</head>
<body>
    <h1 id="title">CS 490 Project</h1>
    <div class=main>
        <div class=heading>
             <h2>Register</h2>
             <i class="fas fa-edit"></i>
        </div>
        <div class="registerForm">
            <form action="register.php" method="POST">
                <label for="firstName">First Name:</label><br>
                <input type="text" id="firstName" name="firstName"><br><br>
                <label for="lastName">Last Name:</label><br>
                <input type="text" id="lastName" name="lastName"><br><br>
                <label for="username">Username:</label><br>
                <input type="text" id="userName" name="userName"><br><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br><br>
                <label for="password_c">Confirm Password:</label><br>
                <input type="password" id="password_c" name="password_c"><br><br>
                <input type="submit" value="Register">
              </form>
        </div>

        <div class="register">
            <a href="home.php">Already have an account? Click here to sign in</a>
        </div>
    </div>

    <!-- JavaScript -->
     <script src="js/main.js"></script>
</body>
</html>
