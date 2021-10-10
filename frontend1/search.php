<?php
session_start();


// var_dump($_SESSION);
$username = $_SESSION['username'];
$userId = $_SESSION['user_id'];
require_once("../backend/user_utils.php");
require_once("../backend/announcement_utils.php");


  $allResults = getAnnouncements();

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

    <title>DEC BOOK</title>
</head>


<body>
  <?php include('header.php')?>
  <div class="container">
    <div class="jumbotron">
      <div class="row">
        <h1 class="text-center"><?php echo "Welcome ".  $username ?></h1>
      </div>
    </div>
    <div class="col-12">
      <form>
      <div class="input-group input-group-lg">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-lg">Search For User</span>
        </div>
        <input type="text" name="search" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        <button type="submit" class="btn btn-sm btn-info" >Search</button>
      </div>
    </form>
    </div>



</div>

          <?php
          if(!empty($_GET) && !empty($_GET["search"])){
              $rows = getListOfUsersLike($_GET["search"]);
              foreach($rows as $row){
                ?>
                <div class="profileSearch">
                    <h4>Name <a href="./profile.php?user=<?php echo $row["userName"]; ?>"><?php echo $row["firstName"]." ".$row["lastName"]; ?></h4>
                    <a class="btn btn-primary btn-sm" href="./announcements.php?user=<?php echo $row["userName"]; ?>" >View Announcements</a>

                    <?php
                      if($userId !== $row['user_id'] ){?>
                        <a id="messageButton" recieverId='<?php echo $row['user_id']  ?>' senderId='<?php echo $userId  ?>' class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#messageModal" >Message</a>

                        <a href="../index.php?sender=<?php echo $username  ?> &reciever=<?php echo $row['userName']  ?>"  class="btn btn-info btn-sm" >Chat</a>

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
        <h4>All Announcements</h4>
      <?php


      if(count($allResults) > 0 ){

        foreach($allResults as $result){

            $postId = $result['post_id'];

          echo  "<div class='profileSearch'>".

                      "<h4>By:" . $result['userName']. "</h4>".
                      "<p>". $result['body']. "</p>".
                      "<a class='btn btn-primary btn-sm' href='view.php?id=$postId'>View </a>".
                      "<h4>Date:".$result['created_at']. "</h4>".
                  "</div>";
        }

      }else{
        echo "<h1>" . "No Available Announcemen" . "</h1>";
      }




       ?>

    </div>


  </div>
<?php include('footer.php') ?>
</body>


</html>
