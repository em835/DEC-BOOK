<?php
session_start();


// var_dump($_SESSION);
$username = $_SESSION['username'];

$userId = $_SESSION['user_id'];
require_once("../backend/user_utils.php");
require_once("../backend/announcement_utils.php");


$allResults = getAnnouncements();
$result = requestByUsernameSQL($_SESSION['username']);

// var_dump($allResults);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- FontAwesome CSS-->
  <script src="https://kit.fontawesome.com/a72b2bc306.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/styles.css">

  <link rel="stylesheet" href="rating-system/css/rating-style.css">
  <title>DEC BOOK</title>
</head>


<body>
  <?php include('header.php') ?>
  <div class="container">
    <div class="jumbotron ">
      <div class="row d-flex " style="justify-content: space-between;">
        <h1 class="text-center"><?php echo "Welcome " .  $username ?></h1>




        <?php
            if($result['user_image'] == null){?>
            <div class="profileMain  col-3 " >
              <i class="fas fa-user-circle"></i>
              <div id="dummy" class="img-thumbnail"></div>

              <?php } else {?>

              <img class="rounded-circle"  src="<?php echo $result['user_image']   ?>" alt="" srcset="" width="150px" height="150px" style="position:relative">


             


              <?php } ?>
      </div>

    </div>
    <div class="col-12">
      <form>
        <div class="input-group input-group-lg">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-lg">Search For User</span>
          </div>
          <input type="text" name="search" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
          <button type="submit" class="btn btn-sm btn-info">Search</button>
        </div>
      </form>
    </div>
  </div>

  <?php
  if (!empty($_GET) && !empty($_GET["search"])) {
    $rows = getListOfUsersLike($_GET["search"]);
    foreach ($rows as $row) {
  ?>
      <div class="profileSearch">
        <div class="row d-flex" style="justify-content:space-between">

        <h4>Name <a href="./profile.php?user=<?php echo $row["userName"]; ?>"><?php echo $row["firstName"] . " " . $row["lastName"]; ?></h4>



        <img class="rounded-circle"  src="<?php echo $row['user_image']   ?>" alt="" srcset="" width="150px" height="150px" style="position:relative">
        </div>
        
        <a class="btn btn-primary btn-sm" href="./announcements.php?user=<?php echo $row["userName"]; ?>">View Announcements</a>

        <?php
        if ($userId !== $row['user_id']) { ?>
          <a id="messageButton" recieverId='<?php echo $row['user_id']  ?>' senderId='<?php echo $userId  ?>' class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#messageModal">Message</a>

          <a href="../index.php?sender=<?php echo $username  ?> &reciever=<?php echo $row['userName']  ?>" class="btn btn-info btn-sm">Chat</a>

        <?php }
        ?>

      </div>
  <?php
    }
  }
  ?>
  </div>
  </div>

  <div class="announcements">
    <h4 id="bodyTitle">All Announcements</h4>

    <?php
    if (count($allResults) > 0) {
      foreach ($allResults as $result) {
        $userIconName = '<i class="fas fa-user-circle" id="userIdIcon"></i>';
        $userDisplayName = "<h2> $result[userName] </h2>";

        $postId = $result['post_id'];
    ?>

        <div class='profileSearch'>
          <div class='row'>
           
            <div class='col-11'>
                <?php if ($result['user_image'] == ""){

                ?>

              <div class='col-1'>
                <i class="fas fa-user-circle" id="userIdIcon"></i>
              </div>
                <?php } else { ?>
                <img class="rounded-circle"  src="<?php echo $result['user_image']   ?>" alt="" srcset="" width="40px" height="40px" style="position:relative">

              <?php } ?>
                <div class="row">
                <h2> <?php echo $result['userName'] ?> </h2>
              </div>
            </div>
          </div>
          <br>
          <h3> <?php echo $result['body'] ?> </h3>
          <br>
          <?php echo "<a class='btn btn-primary btn-sm' href='view.php?id=$postId'>View </a>" ?>
          <br>
          <br>
          <?php
                $userId = $_SESSION['user_id'];
                include_once('rating-system/rating-config.php'); 
            ?>
              <form action="rating-config.php" method="POST">

<div class='row'> 
    <button type="button" class="btn btn-sm btn-success" id="upvote-button" onclick="ratingSystem(1, 'upvoteElement_', <?php echo $result['post_id']; ?>)">Upvote</button> 
    <h6 id='upvoteElement_<?php echo $postId ?>'>Upvotes: <?php foreach (displayUpvote($postId) as $upvote) {echo ("$upvote");} ?> </h6>
</div>
<div class='row'>
  <button type="button" class="btn btn-sm btn-danger" id="downvote-button" onclick="ratingSystem(2, 'downvoteElement_',  <?php echo $result['post_id']; ?>)">Downvote</button>
  <h6 id='downvoteElement_<?php echo $postId ?>'>Downvotes: <?php foreach (displayDownvote($postId) as $downvote) {echo ("$downvote");} ?> </h6> 
</div>

</form> 
            <br>
          <h6>Posted on: <?php echo $result['created_at'] ?> </h6>
        </div>
<!-- 


        echo  "<div class='profileSearch'>" .

          "<h4>By:" . $result['userName'] . "</h4>" .
          "<p>" . $result['body'] . "</p>" .
          "<a class='btn btn-primary btn-sm' href='view.php?id=$postId'>View </a>" .
          
          "<h4>Date:" . $result['created_at'] . "</h4>" .
          "</div>"; -->

    <?php
      }
    } else {
      echo "<h1>" . "No Available Announcement" . "</h1>";
    }
    ?>

  </div>

  </div>
  <?php include('footer.php') ?>

  <script src="rating-system/js/rating.js"></script>
  <script src="js/main.js"></script>
</body>


</html>