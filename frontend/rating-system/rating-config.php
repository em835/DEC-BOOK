<?php

include("db-config.php");

$ajaxPostType = $_POST['type'] ?? ''; // ?? '' is a Null Coalesce Operator, which fixes "Notice: Undefined variable" error.

if ($ajaxPostType == 1) {
  addUpvote();
}

if ($ajaxPostType == 2) {
  addDownvote();
}

function displayUpvote($postId)
{
  
  include("db-config.php");
  $selectQuery = "SELECT (upvote_downvote) FROM posts WHERE post_id = $postId";

  $selectQueryResult = mysqli_query($dbConnection, $selectQuery);
  if (!$selectQueryResult) {
    mysqli_close($dbConnection);
    throw new Exception(mysqli_error($dbConnection));
  }

  $upvotes = mysqli_fetch_assoc($selectQueryResult);
  mysqli_close($dbConnection);

  
  return ($upvotes['upvote_downvote']);
}

function displayDownvote($postId)
{
  include("db-config.php");
  $selectQuery = "SELECT SUM(downvotes) FROM posts WHERE post_id = $postId";

  $selectQueryResult = mysqli_query($dbConnection, $selectQuery);
  if (!$selectQueryResult) {
    mysqli_close($dbConnection);
    throw new Exception(mysqli_error($dbConnection));
  }

  $downvotes = mysqli_fetch_assoc($selectQueryResult);
  mysqli_close($dbConnection);

  // echo $downvotes;
 
  return ($downvotes["SUM(downvotes)"]);
  // return ($upvotes['upvote_downvote']);


}





function addUpvote()
{
  $postId = $_POST['postId'];
  $userId = $_POST['userId'];

  include("db-config.php");


  // check if user has already voted before 
  $sql = "SELECT * from post_rating WHERE post_id= $postId AND user_id= $userId";
  
  $query = mysqli_query($dbConnection, $sql);
  $row = mysqli_num_rows($query); 

  if ($row == 0 )
  {
    // create voting record and update
    $sql = "INSERT INTO post_rating (user_id, post_id, vote) VALUES ('$userId', '$postId', 1)";

    if(mysqli_query($dbConnection, $sql))
    {
      // get number of times a post has been upvoted
      $upvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = 1";
      $upvoteQUERY = mysqli_query($dbConnection, $upvoteSQL);
      $num_upQuery = mysqli_num_rows($upvoteQUERY);



      // get number of times a post has been downvoted

      $downvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = -1";
      $downvoteQUERY = mysqli_query($dbConnection, $downvoteSQL);
      $num_downQuery = mysqli_num_rows($downvoteQUERY);
     
            //  update query
            $updatePosts = "UPDATE posts SET upvotes = $num_upQuery, 
            downvotes = $num_downQuery, 
            upvote_downvote = $num_upQuery WHERE post_id='$postId'"; 
    
          $updatePostsQuery = mysqli_query($dbConnection, $updatePosts); 
    
          if($updatePostsQuery){
            $upvote =  displayUpvote($postId);
            $downvote =  displayDownvote($postId);
    
            $data = array('upvote'=>$upvote, 'downvote' => $downvote );
            echo json_encode($data);
          }
      


    

    }else{
      echo ('ERROR'. mysqli_error($dbConnection));
    }

     
    
  }
  elseif ($row == 1) 
  {
    // update upvote without creating new record

    // update post_rating table 
    $sql2 = "UPDATE post_rating SET vote = 1 WHERE user_id= $userId AND post_id = $postId";
    $query2 = mysqli_query($dbConnection, $sql2);
    if($query2)
    {
     // get number of times a post has been upvoted
      $upvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = 1";
      $upvoteQUERY = mysqli_query($dbConnection, $upvoteSQL);
      $num_upQuery = mysqli_num_rows($upvoteQUERY);



      // get number of times a post has been downvoted

      $downvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = -1";
      $downvoteQUERY = mysqli_query($dbConnection, $downvoteSQL);
      $num_downQuery = mysqli_num_rows($downvoteQUERY);
     


      $updatePosts = "UPDATE posts SET upvotes = $num_upQuery, 
        downvotes = $num_downQuery, 
        upvote_downvote = $num_upQuery WHERE post_id='$postId'"; 

      $updatePostsQuery = mysqli_query($dbConnection, $updatePosts); 

      if($updatePostsQuery){
        $upvote =  displayUpvote($postId);
        $downvote =  displayDownvote($postId);

        $data = array('upvote'=>$upvote, 'downvote' => $downvote );
        echo json_encode($data);
      }

    }else{
      die('Error' . mysqli_error($dbConnection));

    }
  
  }
  mysqli_close($dbConnection);

}





  

  



function addDownvote()
{
  $postId = $_POST['postId'];
  $userId = $_POST['userId'];

  include("db-config.php");


  // check if user has already voted before 
  $sql = "SELECT * from post_rating WHERE post_id= $postId AND user_id= $userId";
  
  $query = mysqli_query($dbConnection, $sql);
  $row = mysqli_num_rows($query); 

  if ($row == 0 )
  {
    // create voting record and update
    $sql = "INSERT INTO post_rating (user_id, post_id, vote) VALUES ('$userId', '$postId', -1)";

    if(mysqli_query($dbConnection, $sql))
    {
      // get number of times a post has been upvoted
      $upvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = 1";
      $upvoteQUERY = mysqli_query($dbConnection, $upvoteSQL);
      $num_upQuery = mysqli_num_rows($upvoteQUERY);


      


      // get number of times a post has been downvoted

      $downvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = -1";
      $downvoteQUERY = mysqli_query($dbConnection, $downvoteSQL);
      $num_downQuery = mysqli_num_rows($downvoteQUERY);
     


        //  update query
   
        $updatePosts = "UPDATE posts SET upvotes = $num_upQuery, 
        downvotes = $num_downQuery, 
        upvote_downvote = $num_upQuery  WHERE post_id = '$postId'"; 

      $updatePostsQuery = mysqli_query($dbConnection, $updatePosts); 

      if($updatePostsQuery){
        $upvote =  displayUpvote($postId);
        $downvote =  displayDownvote($postId);

        $data = array('upvote'=>$upvote, 'downvote' => $downvote );
        echo json_encode($data);
      }

    }
    
  }
  elseif ($row == 1) 
  {
    // update upvote without creating new record

    // update post_rating table 
    $sql2 = "UPDATE post_rating SET vote = -1 WHERE user_id= $userId AND post_id = $postId";
    $query2 = mysqli_query($dbConnection, $sql2);
    if($query2)
    {
     // get number of times a post has been upvoted
      $upvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = 1";
      $upvoteQUERY = mysqli_query($dbConnection, $upvoteSQL);
      $num_upQuery = mysqli_num_rows($upvoteQUERY);



      // get number of times a post has been downvoted

      $downvoteSQL = "SELECT vote from post_rating WHERE post_id = $postId AND vote = -1";
      $downvoteQUERY = mysqli_query($dbConnection, $downvoteSQL);
      $num_downQuery = mysqli_num_rows($downvoteQUERY);
     


      $updatePosts = "UPDATE posts SET upvotes = $num_upQuery, 
        downvotes = $num_downQuery, 
        upvote_downvote = $num_upQuery WHERE post_id = '$postId'"; 

      $updatePostsQuery = mysqli_query($dbConnection, $updatePosts); 

      if($updatePostsQuery){
        $upvote =  displayUpvote($postId);
        $downvote =  displayDownvote($postId);

        $data = array('upvote'=>$upvote, 'downvote' => $downvote );
        echo json_encode($data);
      }

    }else{
      die('Error' . mysqli_error($dbConnection));

    }
  
  }
  mysqli_close($dbConnection);

}




  

  




