<!DOCTYPE html><!-- Admin Login -->
<html lang="en">
	<head>
		<link href="styles/signin.css" rel="stylesheet" type="text/css">
		<link href="styles/myowncss.css" rel="stylesheet" type="text/css">
	</head>

	<body>
	 	<div class="login">
		 	<h2><?php echo @$_GET['not_admin']; ?></h2>
		 	<h2><?php echo @$_GET['logged_out']; ?></h2>
			<h1>Admin Login</h1>
		    <form method="POST" action="login.php">
		    	<input type="email" name="email" placeholder="Email" required="required" />
		        <input type="password" name="password" placeholder="Password" required="required" />
		        <button type="submit" class="btn btn-primary btn-block btn-large" name="login" >Login</button><br />
		    </form>
		    <a href="../index.php"><button type="button" class="btn btn-primary btn-block btn-large">Client</button></a>
	    </div>
	</body>
</html>

<?php
	session_start();
	include("includes/db.php");

	if (isset($_POST['login'])) {
		$email = mysql_real_escape_string($_POST['email']);				//To prevent form SQL injection
		$password = mysql_real_escape_string($_POST['password']);		//To prevent form SQL injection
		$select_user = "select * from admins where user_email = '$email' AND user_password = '$password'";
		$run_user = mysqli_query($con, $select_user);
		$check_user = mysqli_num_rows($run_user);
		if($check_user == 0){
			echo "<script>alert('Password or Email is Incorrect. Try Again!')</script>";
		}else{
			$_SESSION['user_email'] = $email;
			echo "<script>window.open('index.php?logged_in=You Have Successfully Logged In', '_self')</script>";
		}
	}
?>