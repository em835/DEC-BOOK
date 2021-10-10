<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Chat</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">

	<style type="text/css">
		#messages {
			height: 100%;
			overflow-y: auto;
			display: d-block;
			flex-direction: row;
		}
		#incomingMsg {
			/* flex-direction: unset; */

		}
		#chat-room-frm {
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<div class="container-fluid">

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="./frontend/search.php">CS 490</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item ">
						<a class="nav-link" href="./frontend/search.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="./frontend/profile.php">My Profile <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./frontend/announcements.php">Announcements</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="./frontend/messages.php">My Messages</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="./chatroom.php">Chat</a>
					</li>

					<li class="nav-item">
						<a href="./frontend/logout.php" class="btn btn-danger btn-lg">Logout</a>
					</li>

				</ul>

			</div>
		</nav>

		<div class="row" id="subBody">
			<div class="col-md-4">
				<?php
					session_start();
					if(!isset($_SESSION['user'])) {
						header("location: index.php");
					}

				 ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th colspan="3"> <h4>Users</h4> </th>
						</tr>
						<tr>
							<td>
								<?php
									foreach ($_SESSION['user'] as $key => $user) {
										$userId = $key;
										if($userId === 0){
											echo '<h6>' . 'ME' . '</h6>';
											echo '<hr>';
										}else{
											echo '<input type="hidden" name="userId" id="userId" value="'.$key.'">';
											echo  "<span class='text-left'>". $user['userName']. "</span>";
												 
										}

									}
								 ?>
							</td>

						</tr>

					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="col-md-8 p-5 ">
				<div id="messages" class="" style="height: 50vh">
				</div>

				<form id="chat-room-frm" method="post" action="">
					<div class="form-group">
						<input type="hidden" name="" id="senderName" value="<?php echo $_SESSION['user'][0]['userName'] ?>">

						<input type="hidden" name="" id="recieverId" value="<?php echo $_SESSION['user'][1]['user_id'] ?>">

						<input type="hidden" name="" id="senderId" value="<?php echo $_SESSION['user'][0]['user_id'] ?>">


						<input type="hidden" name="" id="currentText">
						<textarea class="form-control" id="msg" name="msg" placeholder="Enter Message"></textarea>
					</div>

					<div class="form-group">
						<input type="button" value="Send" class="btn btn-success btn-block" id="send" name="send">
					</div>

				</form>

			</div>
		</div>
	</div>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(document).ready(function () {
			var isSecure = location.protocol === "http:";
			var hostname = location.hostname;

			var wsLocation = "ws" + (isSecure ? "s" : "") + "://" + hostname;

			wsLocation = 'ws://68.183.26.2/ws'; 
			var conn = new WebSocket(wsLocation);
			conn.onopen = function (e) {
				console.log("Connection established!");
			};


			var recieverId = $("#recieverId").val();
			var senderId = $("#senderId").val();
			

			conn.onmessage = function (e) {
				console.log('MESSAGE', e.data);
				var myUsername = $("#username").val();
				var data = JSON.parse(e.data);
				var messagesDiv = $("#messages");

				var myMsg = '';
				console.log('data', data)

				myMsg = `
				<div class="col-6 d-block">
				<div class='row mb-3 ml-3'>
						<span class='badge badge-danger'>${data.username}</span>
						<div class='col-6 text-left badge badge-primary text-wrap'> <p>${data.msg}<p></div>

						</div></div>`;
				messagesDiv.append(myMsg)



				// get sender name and receiever from message object

			};

			$("#send").on('click', function (e) {
				e.preventDefault();
				var msgDiv = $("#msg");
				var username = $("#senderName");
				var userId = $("#senderId");
				var currentText = $("#currentText");
				var msg = msgDiv.val();
				currentText.val(msg);



				currentText = $("#currentText").val();
				var outDiv = $("#messages");
				var myMsg = '';
				if (currentText !== '') {
					myMsg = `
					<div class="row   justify-content-end ">
					<div class='col-4 mb-3 ml-3 float-right'>
						<span class='badge badge-danger'>Me</span>
						<div class='col-6 text-left badge badge-primary text-wrap'> <p>${currentText}<p></div>

						</div></div>`;
					outDiv.append(myMsg)
				}


				username = username.val();
				console.log('username', username)
				msgDiv.val('');
				var dataSend = {
					msg: msg,
					username: username,
					userId: senderId
				}
				dataS = JSON.stringify(dataSend);
				conn.send(dataS);


				// save the message to the database

				$.ajax({
					url: "./backend/message_process.php",
					method: "POST",
					data: {
						senderId: senderId,
						recieverId: recieverId,
						messageText: currentText,
						send_message: 1
					},
					success: function (data) {
						// console.log('data', data)
					},
					error: function (err) {
						console.log('err', err)
					}
				})

			})
		})
	</script>
</body>

</html>
