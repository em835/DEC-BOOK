
<?php
session_start();
// if(!isset($_SESION['user'])){
//   header("Location: frontend/login.php");
// }
if(isset($_GET['reciever']) && isset($_GET['sender'])){
  // get sender and the reciever info
  require('./backend/user_utils.php');
  require('./db/users.php');

  $senderUsername = $_GET['sender'];
  $recieverUsername = $_GET['reciever'];

  $senderInfo= requestByUsernameSQL($senderUsername);
  $recieverInfo= requestByUsernameSQL($recieverUsername);


  $user= new users;
  $user->setEmail($senderInfo['email']);

  $user->setName($senderInfo['userName']);



  $userData = $senderInfo;
  if(is_array($userData) && count($userData)> 0){
    $user->setId($userData['user_id']);

      $_SESSION['user'][] = $userData;
      $_SESSION['user'][] = $recieverInfo;

      echo "User Logged In";
      header("Location: chatroom.php");


  }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,      initial-scale=1.0">
  <title>Chat App </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="POST">


      <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" id="uname" name="uname" class="fadeIn second"  placeholder="Username">
      </div>

      <div class="form-group">
        <label for="username">E-mail</label>
        <input class="form-control" type="email" id="email" name="email" class="fadeIn second"  placeholder="E-mail">
      </div>

      <div class="form-group">
        <label for="username">Password</label>
        <input type="text" id="password" class="fadeIn third form-coontrol" name="password" id="password" placeholder="password">
      </div>
    <div class="form-group">
    <input name="join" type="submit" class="fadeIn fourth" value="Log In">

    </div>

    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
</body>
</html>
