<?php
session_start();
$userId = $_SESSION['user_id'];

if(!empty($_GET['id'])){
  $postId = $_GET['id'];

  require('../backend/announcement_utils.php');
  $result = getAnnouncementsById($postId);
  $comments = getAnnouncementComments($postId);


  $username = $result['userName'];
  $postId = $result['post_id']; 
  $body = $result['body'];
  $time = $result['created_at'];

  // get All annoucements


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <style>
  
  body { padding-top:30px; }
.widget .panel-body { padding:0px; }
.widget .list-group { margin-bottom: 0; }
.widget .panel-title { display:inline }
.widget .label-info { float: right; }
.widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
.widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
.widget .mic-info { color: #666666;font-size: 11px; }
.widget .action { margin-top:5px; }
.widget .comment-text { font-size: 12px; }
.widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }
  
  </style>

</head>
<body>
<?php include('header.php')?>

<div class="container">
  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-8">

      <!-- Title -->
    <h3 class="mt-4">Annoucent By <?php  echo $username ?></h3>

      <!-- Author -->
     

      <hr>

            <!-- Date/Time -->
    <p>Posted on <?php echo $time ?></p>

      


      <hr>

      <h5>Details</h5>
      
      <!-- Post Content -->
    <?php echo $body ?>

     <hr>
    


      <div class="row mt-3">
       
      <div class="form-group col-12">
        <label for="exampleFormControlTextarea1">Add Comment</label>
        <textarea class="form-control" id="comment_value" rows="3"></textarea>
      </div>
      <input id="postId" type="hidden" name="" value="<?php  echo $postId ?>">
      <input id="userId" type="hidden" name="" value="<?php echo $userId  ?>">
      <div class="col-3">
        <input id="submit_comment" type="button"  class="btn btn-secondary btn-block" value="Submit Comment">
          </div>
      
      </div>

      <!-- Comment with nested comments -->
      
      <div class="row">
        <div class="panel panel-default widget col-12">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title">
                    Viewer Comments</h3>
                <span class="badge badge-info float-right">
                    <?php echo count($comments) . ' '.  'Comments' ?></span>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                  <?php
                    foreach($comments as $comment){

                      ?>
                    <li class="list-group-item">
                        <div class="row">
                          
                            <div class="col-xs-10 col-md-11">
                                <div>
                                   <p><?php echo $comment['comment'] ?></p>
                                    <div class="mic-info">

                                        By: <a href="profile.php?user=<?php echo $comment['userName'] ?>"><?php 
                                        if($comment['userName'] === $_SESSION['username']){
                                          echo 'Author';
                                        }else{
                                           echo  $comment['firstName'] . ' ' .  $comment['lastName'];} ?></a> 
                                        
                                        on <?php  echo $comment['created_at']; ?>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </li>

                    <?php } ?>
                    
                </ul>
               
            </div>
        </div>
    </div>

    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

     

      <!-- Categories Widget -->
    

    </div>

  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script src="js/main.js"></script>
</body>
</html>