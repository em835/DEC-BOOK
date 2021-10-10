<?php
include('../backend/message_utils.php');
session_start();

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $result = readMessage($id);

}
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

    <title>CS490 Project</title>
</head>


<body>
  <?php include('header.php')?>
  <div class="container">
    <div class="jumbotron">
      <div class="row">
        <h4 class="text-center">Message</h4>
      </div>
    </div>
    <div class="col-6 mx-auto">
      <div class="card card-body">
        <p>
              <?php
                foreach ($result as $res) {
                echo '<p>'. '<span class="font-bold">' . $res['userName']. ' >>> '. '</span>' . $res['message_body'] . '<span class="float-right">' . $res['created_at'] . '</span>'. '</p>';
                }
              ?>
        </p>
      </div>
    </div>







  </div>
<?php include('footer.php') ?>
</body>


</html>
