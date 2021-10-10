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
<html>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FontAwesome CSS-->
    <script src="https://kit.fontawesome.com/a72b2bc306.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">

    <title>CS490 Project</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

h2 {
	color: white;
}
</style>
</head>
<body>
  <?php include('header.php')?>
<h2>Chat Messages</h2>



<?php
                foreach ($result as $res) {
				echo "<div class=\"container\">\n";
				
					
                echo '<p>'. '<span class="font-bold">'  . $res['userName']. ' <br> '. '</span>' . $res['message_body'] . '<span class="float-right">' . $res['created_at'] . '</span>'. '</p>';
                

			echo "</div>";
				
				}
?>


</body>
</html>
