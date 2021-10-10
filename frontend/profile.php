<?php
session_start();
  require_once("../backend/user_utils.php");
  require_once("../middle/announcementhandle.php");
  require_once("../backend/announcement_utils.php");


if(isset($_GET['user'])){
  $user = $_GET['user'];
  $result = requestByUsernameSQL($user);



  $results = getAnnouncementsByUserId($user);


}

$result = requestByUsernameSQL($_SESSION['username']);
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

    <title>DEC BOOK</title>
    <style>
    
    label {
   cursor: pointer;
   /* Style as you please, it will become the visible UI component. */
   background: red;
  padding: 5px;
  position: absolute;
  border: 1px solid;
  top: 0px;
  right: 0px;

}

#takePicture {
   opacity: 0;
   position: absolute;
   z-index: -1;
}
    
    </style>
</head>

<body>
    <?php include('header.php')?>
  <div class="container">
      <div class="row">
        <div class="col-4 mx-auto ">
          
          <input type="hidden" name="" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">
         
            
           

        </div>
      </div>
      <div class="">
        <div class="col-8 mx-auto card card-body">
          <div class="row">
              <div class="col-6">
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
              </div>
              <div class="col-6">

              <div class="profileMain">
              <label for="takePicture">Update</label>

              <input  id="takePicture" type="file" accept="image/*">

            <img id="myImg" src="#" class="border" alt="your image" height="150" width="150" style="display:none">
            <?php
            if($result['user_image'] == null){?>
              <i class="fas fa-user-circle"></i>
              <!-- <div id="dummy" class="img-thumbnail"></div> -->

              <?php } else {?>

              <img class="rounded-circle "  src="<?php echo $result['user_image']   ?>" alt="" srcset="" width="150px" height="150px" style="position:relative">


             


              <?php } ?>

            </div>
          </div>
              </div>
            



            
          



          
        </div>
                

        



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
            $postId = $result['post_id'];

            echo  "<div class='profileSearch'>".

                        "<h4>Announcement:</h4>".
                        "<p>". $result['body']. "</p>".

                        "<a class='btn btn-primary btn-sm' href='view.php?id=$postId'>View </a>".


                        "<h4>Date:".$result['created_at']. "</h4>".
                    "</div>";

}
           ?>

    </div>

    
        <hr>
        <?php
        if(isset($_GET['user'])){

          $rows = getAnnouncementsByUserId($current_user["user_id"]);

          foreach($rows as $row){
          ?>
                    <div class="displayAnnouncement">
                        <div><?php echo $row["body"]; ?></div>

                        <hr>
                    </div>
          <?php        }

        }

         ?>
    </div>



    <!-- JavaScript -->
    <?php include('footer.php') ?>

<script>

window.onload = function(){
  getImage()
}

function getImage() {

  var fileBag = document.getElementById('takePicture')


  var img = document.getElementById('myImg');  // $('img')[0]


  document.querySelector('input[type="file"]').addEventListener('change', function () {
    if (this.files && this.files[0]) {
      img.src = URL.createObjectURL(this.files[0]); // set src to blob url
      img.style.visibility = 'hidden'

      encodeImageFileAsURL(this.files)
    }
  });



}



 
function encodeImageFileAsURL(images) {


  var filesSelected = images;
  if (filesSelected.length > 0) {
    var fileToLoad = filesSelected[0];

    var fileReader = new FileReader();

    fileReader.onload = function (fileLoadedEvent) {
      var srcData = fileLoadedEvent.target.result; // <--- data: base64


      saveImage(srcData);

      console.log('image data', srcData);
      srcData = srcData.replace(/^data:image\/[a-z]+;base64,/, "");


      document.getElementById('image_profile').value = srcData;
      document.getElementById('aftersnaptext2').style.visibility = 'visible';

      document.getElementById('clearsnapshotbutton').style.visibility = 'visible';

      document.getElementById('takesnapshotbutton').style.visibility = 'hidden';

      document.getElementById('aftersnaptext2').style.visibility = 'visible';

    }
    fileReader.readAsDataURL(fileToLoad);
  }
}     


function saveImage (img){

  let user_id =document.getElementById('user_id').value;

// send data to server
$.ajax({
      url: "../backend/imageUpload.php",
      method: "POST",
      cache: false,
      data: {
        userId: user_id,
        userImage : img, 
        imageUpload: 1
      },
      success: function (data) {
       window.location.reload();
      },
      error: function () {
        alert("Failed");
      }
    })

}

</script>
</body>


</html>
