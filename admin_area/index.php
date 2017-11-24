<?php
	session_start();
	if (!isset($_SESSION['user_email'])) {
		echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
	}else{
?>

<!DOCTYPE>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="Nepal">
	    <meta name="author" content="Sulabh Shrestha">
	    <link rel="icon" href="favicon.ico">
	    <title>Admin</title>

	     <!-- Custom Made CSS -->
	    <link href="styles/admin.css" rel="stylesheet" type="text/css" >
	    <!-- Bootstrap core CSS -->
	    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
  	</head>

  	<body>
  		<div class="main_wrapper">	
  			<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			  	<div class="" ="navbar-header">
				    <a class="navbar-brand" href="index.php">Admin Panel</a>
			  	</div>
			  	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    	<ul class="nav navbar-nav">
				      	<li><a href="index.php?insert_highlights">Insert</a></li>
				      	<li><a href="index.php?view_highlights">View</a></li>
				      	<li><a href="logout.php">Logout</a></li>
			    	</ul>
			  	</div>
			</nav>

			<div id="adminPanel">
				<h2 id="welcomeSign"><?php echo @$_GET['logged_in']; ?></h2>
				<div id="content">

					<?php
						if (isset($_GET['insert_highlights'])) {
							include("insert_highlights.php");
						}

						if (isset($_GET['view_highlights'])) {
							include("view_highlights.php");
						}

						if (isset($_GET['edit_highlights'])) {
							include("edit_highlights.php");
						}
					?>
					
				</div>
			</div>
		</div>
		
     	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="../dist/js/bootstrap.min.js"></script>   
  	</body>
</html>

<?php } ?> <!-- bracket of else -->