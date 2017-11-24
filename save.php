<!DOCTYPE>
<?php
	session_start();
	include ("functions/functions.php");
?>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="Nepal">
	    <meta name="author" content="Sulabh Shrestha">
	    <link rel="icon" href="favicon.ico">
	    <title>Beautiful Nepal</title>
	    <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>

	 	<!-- Custom Made CSS -->
		<link href="styles/registrationcss.css" rel="stylesheet" type="text/css">
		<link href="styles/mynewcss.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap core CSS -->
	    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
  	</head>

  	<body>
  		<div class="main_wrapper">
  		<!-- Navigation Section -->	
  			<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			  	<div class="" ="navbar-header">
				    <a class="navbar-brand" href="index.php">Nepal</a>
			  	</div>
			  	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    	<ul class="nav navbar-nav">
				      	<li><a href="index.php">Home</a></li>
				      	<li><a href="pointofinterest.php">PointOfInterest</a></li>
				      	<li>
					      	<a href="
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "customer/my_account.php";
									}else{
										echo "save.php";
									}

								?>
					      		">My Account
					      	</a>
				      	</li>
				      	<li><a href="favourites.php">Favourites</a></li>
				      	<li>
				      		<a href="
						      	<?php
						      		if (isset($_SESSION['customer_email'])) {
										echo "customer_logout.php";
									}else{
										echo "customer_register.php";
									}
						      	?>
					      		">
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "Logout";
									}else{
										echo "Sign Up";
									}
								?>
					      	</a>
					    </li>
					    <li class="active">
				      		<a href="
						      	<?php
						      		if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "save.php";
									}
						      	?>
					      		">
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "Sign In";
									}
								?>
					      	</a>
					    </li>
					    <li>
				      		<a href="
						      	<?php
						      		if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "admin_area/login.php";
									}
						      	?>
					      		">
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "Admin";
									}
								?>
					      	</a>
					    </li>
			    	</ul>
				    <div class="col-sm-3 col-md-3" id="fullSearchButton">
				        <form method="get" action="results.php" enctype="multipart/form-data" class="navbar-form" role="search">
					        <div class="input-group">
					            <input type="text" class="form-control" id="searchTextBox" placeholder="Search" name="user_query">
					            <div class="input-group-btn">
					                <button class="btn btn-default" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
					                <!-- <input type="submit" name="search" value="Search"> -->
					            </div>
					        </div>
				        </form>
				    </div>
			  	</div>
			</nav>
			<!-- Login Section -->
			<div id="save">
				<?php
					if (!isset($_SESSION['customer_email'])) {
						include("customer_login.php");
					}
				?>
		    </div>
	    </div>
     	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="dist/js/bootstrap.min.js"></script>   

  	</body>
</html>
