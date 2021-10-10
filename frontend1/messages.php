<?php
include('../backend/message_utils.php');
session_start();
$userId = $_SESSION['user_id'];

$result = getUserMessages($userId);
// get current user messages

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
        <h4 class="text-center">My Messages</h4>
      </div>
    </div>
    <div class="col-12">
      <div class="card card-body">
        <ul>
          <?php
          foreach($result as $res){?>


          <li class="list-group-item">
            <a href="read_message.php?id=<?php echo $res['user_id'] ?>" class="nav-link">
              <?php echo $res['userName'];  ?>
            </a>
          </li>

          <?php }?>
        </ul>
      </div>
    </div>







  </div>
<?php include('footer.php') ?>
</body>


</html>
