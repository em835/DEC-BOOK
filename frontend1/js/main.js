$(document).ready(function () {

  var editor = $("#announcement");

  if (editor.length > 0) {
    CKEDITOR.replace('announcement', {
      filebrowserUploadUrl: "../backend/upload.php"
    });
  }



  $("#submit_btn").on("click", function () {


    console.log('Submit clicked')
    var userId = $("#userId").val();
    var textValue = CKEDITOR.instances['announcement'].getData()
    console.log('textValue', textValue);


    $.ajax({
      url: "../backend/announcement_process.php",
      method: "POST",
      cache: false,
      data: {
        userId: userId,
        text: textValue,
        submit_annoucement: 1
      },
      success: function (data) {
        alert(data);
      },
      error: function () {
        alert("Failed");
      }
    })



  })



  // submit user comment

  $("#submit_comment").on("click", function () {


    var userId = $("#userId").val();
    var postId = $("#postId").val();
    var commentValue = $("#comment_value").val();



    $.ajax({
      url: "../backend/announcement_process.php",
      method: "POST",
      cache: false,
      data: {
        userId: userId,
        comment: commentValue,
        postId: postId,
        submit_comment: 1
      },
      success: function (data) {
        alert(data)
        window.location.reload();
      },
      error: function () {
        alert("Failed");
      }
    })



  })



  // message modal

  $(document).on("click", "#messageButton", function () {

    var reciever = $(this).attr('recieverId');
    var sender = $(this).attr('senderId');

    var recieverId = $("#recieverId");
    var senderId = $("#senderId");

    recieverId.attr('data-id', reciever);

    senderId.attr('data-id', sender);

  });


  $(document).on("click", "#sendMessage", function () {

    var recieverId = $("#recieverId").attr('data-id');
    var senderId = $("#senderId").attr('data-id');

    var messageText = $("#messageValue").val();


    // send the message to the server


    $.ajax({
      url: "../backend/message_process.php",
      method: "POST",
      cache: false,
      data: {
        senderId, recieverId, messageText,
        send_message: 1
      },
      success: function (data) {
        alert('Message Sent!!');
        window.location.reload();
      },
      error: function () {
        alert("Failed");
      }
    })



  });




})
