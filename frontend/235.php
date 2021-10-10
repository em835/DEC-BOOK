<?php
  require_once("../backend/user_utils.php");
  require_once("../middle/announcementhandle.php");
  require_once("../backend/announcement_utils.php");


if(isset($_GET['user'])){
  $user = $_GET['user'];
  $result = requestByUsernameSQL($user);



  $results = getAnnouncementsByUserId($user);


}

  print_r($FORM_STATUS);

  $current_user = ensureUserSession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FontAwesome CSS-->
    <script src="https://kit.fontawesome.com/a72b2bc306.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">

    <title>CS490 Project</title>
</head>

<body>
  <div class="container">
    <?php include('header.php')?>


  </div>
    <h1 id="title">CS 490 Project</h1>

    <div class="navbar">
      <div class="navbar">
          <a href="search.php" class="btn btn-primary btn-lg" id="">Search For Users</a>
          <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>

      </div>    </div>

    <div class="profileMain">
        <i class="fas fa-user-circle"></i>
        <?php if(isset($_GET['user'])){?>
        <h3 id="firstName">First Name: <?php echo $result['firstName']?></h3>
        <h3 id="lastName">Last Name: <?php echo $result['lastName'] ?></h3>
        <br>
        <h3>Other Info</h3>
        <h4>Username: <?php echo $result['userName'] ?></h4>
      <?php } else {
        $result = requestByUsernameSQL($_SESSION['username']);


        ?>

        <h3 id="firstName">First Name: <?php echo $result['firstName']?></h3>
        <h3 id="lastName">Last Name: <?php echo $result['lastName'] ?></h3>
        <br>
        <h3>Other Info</h3>
        <h4>Username: <?php echo $result['userName'] ?></h4>
      <?php }?>


        <h3><a href="home.php" id="logout">Logout</a></h3>

    </div>


    <div class="">
          <?php
          $results = getAnnouncementsByUserId($result['userName']);


          if($_SESSION['username'] === $result['userName']){
            echo " <h1 id='title'>My Annoucements</h1>";
          }else{
            echo " <h1 id='title'>Announcements By: " .$result['userName'] . "</h1>";
          }

          
          
          foreach($results as $result){

            echo  "<div class='profileSearch'>".

                        "<h4>Announcement:</h4>".
                        "<p>". $result['body']. "</p>".
                        "<h4>Date:".$result['created_at']. "</h4>".
                    "</div>";

}
           ?>
    </div>

    <div class="profileMain">

        <div>
            <form action="./profile.php" method="post">
                <h3>Announcements</h3>
                <textarea id="postAannouncement" placeholder="Post an announcement" rows="5" cols="80" required name="announcement"></textarea>
                <button type="submit">Summit</button>
            </form>

        </div>

        <hr>
        <?php
        if(isset($_GET['user'])){

          $rows = getAnnouncementsByUserId($current_user["user_id"]);

          foreach($rows as $row){
          ?>
                    <div class="displayAnnouncement">
                        <h4><?php echo $row["body"]; ?></h4>
                        <hr>
                    </div>
          <?php        }

        }

         ?>
    </div>



    <!-- JavaScript -->
    <?php include('footer.php') ?>
</body>


</html>
