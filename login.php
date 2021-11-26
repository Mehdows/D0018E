<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<style>
			body {
				font-family: Arial, Helvetica, sans-serif;
			}
			form {
				border: 3px solid #f1f1f1;
			}

			input[type="text"],
			input[type="password"] {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				box-sizing: border-box;
			}

			button {
				background-color: #04aa6d;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				width: 100%;
			}

			button:hover {
				opacity: 0.8;
			}

			.cancelbtn {
				width: auto;
				padding: 10px 18px;
				background-color: #f44336;
			}

			.imgcontainer {
				text-align: center;
				margin: 24px 0 12px 0;
			}

			img.avatar {
				width: 20%;
				border-radius: 50%;
			}

			.container {
				padding: 32px;
			}

			span.psw {
				float: right;
				padding-top: 0px;
			}

			/* Change styles for span and cancel button on extra small screens */
			@media screen and (max-width: 300px) {
				span.psw {
					display: block;
					float: none;
				}
				.cancelbtn {
					width: 100%;
				}
			}
		</style>
	</head>
	<body>

<?php
require('databaseCode.php');
session_start();
// When form submitted, check and create user session.
if (isset($_POST['name'])) {
	$name = stripslashes($_REQUEST['name']);    // removes backslashes
	$name = mysqli_real_escape_string($con, $name);
	$pssword = stripslashes($_REQUEST['pssword']);
	$pssword = mysqli_real_escape_string($con, $pssword);
	// Check user is exist in the database
	$query    = "SELECT * FROM `Customers` WHERE name='$name'
				AND pssword='" . md5($pssword) . "'";
	$result = mysqli_query($con, $query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	if ($rows == 1) {
		$_SESSION['name'] = $name;
		// Redirect to user dashboard page
		header("Location: homePage.php");
	} else {
		echo "<div class='form'>
			<h3>Incorrect Username/password.</h3><br/>
			<p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
			</div>";
	}
} else {
?>
<form class="form" method="post" name="login">
	<h2>Login Form</h2>

	<!--- <form action="/action_page.php" method="post"> --->

	<div class="imgcontainer">
		<!--- <img src="img_avatar2.png" alt="Avatar" class="avatar"> --->
		<img
			src="https://i0.wp.com/cad.gov.jm/wp-content/uploads/2017/10/img_avatar2.png?w=499&ssl=1"
			alt="Avatar"
			class="avatar"
		/>
	</div>

	<div class="container">
		<label for="name"><b>name</b></label>
		<input type="text" 
		placeholder="Enter Username" 
		name="name" 
		required />

		<label for="pssword"><b>Pssword</b></label>
		<input
			type="pssword"
			placeholder="Enter Password"
			name="pssword"
			required
		/>

		<input class="link"><a href="createAccount.php" type="submit">Login</a>/>

	</div>

	<div class="container" style="background-color: #f1f1f1">
		<span class="psw">
			<a href="createAccount.php">Create new account</a></span
		>
	</div>
</form>

<?php
}
?>

	</body>
</html>
