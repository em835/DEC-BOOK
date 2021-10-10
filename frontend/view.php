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
  <title>Comments</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/comment-view.css">

  <style>
    .widget .panel-body { padding:0px; }
    .widget .list-group { margin-bottom: 0; }
    .widget .panel-title { display:inline }
    .widget .label-info { float: right; }
    .widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
    .widget li.list-group-item:hover { background-color: rgba(199, 218, 247); }
    .widget .mic-info { color: #666666;font-size: 11px; }
    .widget .action { margin-top:5px; }
    .widget .comment-text { font-size: 12px; }
    .widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }
  </style>

</head>

<body>
  <?php include('header.php')?>

  <div class="container">

    <h3 id="bodySubTitle">Annoucement Details:</h3>
      <!-- Post Content -->
      <h4> <?php echo $body ?> </h4>
      <p>Posted by <?php echo $username ?> on  <?php echo $time ?> </p>

  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row mt-3">
        <div class="form-group col-12">
          <h3 id="bodySubTitle"><label for="exampleFormControlTextarea1">Add Comment</label> </h3>
          <textarea class="form-control" id="comment_value" rows="3"></textarea>
        </div>
        <input id="postId" type="hidden" name="" value="<?php  echo $postId ?>">
        <input id="userId" type="hidden" name="" value="<?php echo $userId  ?>">
        <div class="col-3">
          <input id="submit_comment" type="button"  class="btn btn-secondary btn-block" value="Submit Comment">
            </div>
        </div>
        
        <hr>

        <!-- Comment with nested comments -->
        <div class="row">
          <div class="panel panel-default widget col-12">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-comment"></span>
                  <h3 id="bodySubTitle">Viewer Comments<span class="badge badge-info float-right"><?php echo count($comments) . ' '.  'Comments' ?></span></h3>
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
                                    <p id="replies"><?php echo $comment['comment'] ?></p>

                                      <div class="mic-info">
                                          By: <a href="profile.php?user=<?php echo $comment['userName'] ?>"><?php 
                                          if($comment['userName'] === $_SESSION['username']){
                                            echo 'Author';
                                          }else{
                                            echo  $_SESSION['username'];} ?></a> 
                                          
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
      <div class="col-3">
      
      <?php
                $userId = $_SESSION['user_id'];
                include_once('rating-system/rating-config.php'); 
            ?>
              <form action="rating-config.php" method="POST">

<div class='row' id="upvoteElementDiv"> 
    <button type="button" class="btn btn-sm btn-success" id="upvote-button" onclick="ratingSystem(1, 'upvoteElement_', <?php echo $result['post_id']; ?>, <?php echo $_SESSION['user_id'] ?>)">Upvote</button> 
    <h6 id='upvoteElement_<?php echo $postId ?>'>Upvotes: <?php  echo displayUpvote($postId)  ?> </h6>
</div>
<div class='row' id="downvoteElementDiv">
  <button type="button" class="btn btn-sm btn-danger" id="downvote-button" onclick="ratingSystem(2, 'downvoteElement_',  <?php echo $result['post_id']; ?>, <?php echo $_SESSION['user_id'] ?>)">Downvote</button>
  <h6 id='downvoteElement_<?php echo $postId ?>'>Downvotes: <?php echo  displayDownvote($postId)  ?> </h6> 
</div>
      </div>
    </div>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <?php include('footer.php') ?>

<script src="rating-system/js/rating.js"></script>
</body>
</html>