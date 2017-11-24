<!DOCTYPE>
<?php
	session_start();
	include ("functions/functions.php");
	include ("includes/db.php");
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
	    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

	    <!-- JQuery Section -->
	    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
	    <script>
	        $( document ).ready(function(){
	            $("#txtEmail").blur(function(){
	                var emailnameValue = $("#txtEmail").val();
	                $.ajax({
	                    type: "POST",
	                    url: "js/ajaxcall.php",
	                    data: {u:emailnameValue},
	                    cache:false,
	                    success: function(result){    
	                        if(result.toString() == "found"){   
	                            $("#msg").html("Your e-mail id is not unique to our database");
	                            $("#msg").css("color", "red");
	                        }else if(result.toString() == "not found"){
	                            $("#msg").html("Your e-mail id is unique to our database.");
	                            $("#msg").css("color", "green");
	                        }else{
	                            alert(result);
	                        }
	                    }
	                });        
	            });
	        });
	    </script>
  	</head>

  	<body>
  		<div class="main_wrapper" id="registrationFrom">	
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
				      	<li class="active">
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
					    <li>
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
			<!-- Form Section -->
			<div class="container-fluid" >
				<form action="customer_register.php" method="post" class="register-form" enctype="multipart/form-data"> 
					<div class="row">
			              <h1 id="accountMain"></h1>   
			              <h1 id="accountMain"></h1>
					</div>
					<div class="row">
			            <h1 id="accountMain">Create an Account</h1>   
			           	<hr>
					</div>
			      	<div class="row">      
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="firstName">FIRST NAME</label>
			               	<input name="c_fname" class="form-control" type="text" required="required" value="<?php 
				               if (isset($_POST['c_fname'])) {
				               	echo $_POST['c_fname'];
				               }
				               ?>">    
			           </div>            
			      	</div>
			      	<div class="row">      
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="lastName">LAST NAME</label>
			               	<input name="c_lname" class="form-control" type="text" required="required" value="<?php 
				               if (isset($_POST['c_lname'])) {
				               	echo $_POST['c_lname'];
				               }
				               ?>">    
			           	</div>            
			      	</div>
			      	<div class="row">
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="email">EMAIL</label>
			               	<input name="c_email" class="form-control" type="email" id="txtEmail" required="required" value="<?php 
				               	if (isset($_POST['c_email'])) {
				               	echo $_POST['c_email'];
				               }
				               ?>">   
			           </div>      
			      	</div>
			      	<div class="col"><span id="msg" ></span></div>
			      	<div class="row">
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="password">PASSWORD</label>
			               	<input name="c_password" class="form-control" type="password" required="required" value="<?php 
				               	if (isset($_POST['c_password'])) {
				               	echo $_POST['c_password'];
				               }
				               ?>" >             
			           </div>            
			      	</div>
			      	<div class="row">
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			            	  <label for="country">COUNTRY</label>
			               	<input name="c_country" class="form-control" type="text" required="required" value="<?php 
				               	if (isset($_POST['c_country'])) {
				               	echo $_POST['c_country'];
				               }
				               ?>" >             
			          	</div>            
			      	</div>
			      	<div class="row">
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="ageGroup">AGE GROUP</label>
			               	<select name="c_age" class="form-control">
								<option>16-20</option>
								<option>21-30</option>
								<option>31-40</option>
								<option>41-50</option>
								<option>51-60</option>
								<option>61-70</option>
							</select>             
			           </div>            
			      	</div>
			      	<div class="row">
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="picture" >PICTURE</label>
			                  	<label class="btn btn-default btn-file">
							        <p id="browses">Browse</p> <input type="file" name="c_image" style="display: none;">
							    </label>
			           </div>            
			      	</div>
			      	<div class="row">
			           	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="number">NUMBER</label>
			               	<input name="c_number" class="form-control" type="number" required="required" value="<?php 
				               	if (isset($_POST['c_number'])) {
				               	echo $_POST['c_number'];
				               }
				               ?>">             
			           	</div>            
			      	</div>

			        <div class="row">
			        	<div class="col-md-4 col-sm-4 col-lg-4">
			              	<label for="terms">TERMS</label>
			               	<input name="checkbox" class="form-control" type="checkbox" required="required">             
			           	</div>            
			      	</div>
			      	<hr>
			      	<div class="row">
			           	<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
			           		<button class="btn btn-primary regbutton" name="register" id="customer_registerButton">Register</button>
			          	</div>        
			      	</div>    
			    </form>
			</div>
	    </div>
     	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="dist/js/bootstrap.min.js"></script>   
  	</body>
</html>

<?php
	// Insertion of data
	if (isset($_POST['register'])) {
		global $con;
		$ip = getIp();
		$c_fname = $_POST['c_fname'];
		$c_lname = $_POST['c_lname'];
		$c_email = mysql_real_escape_string($_POST['c_email']);				//Preventing SQL injection
		$c_password = mysql_real_escape_string($_POST['c_password']);		//Preventing SQL injection
		$c_country = $_POST['c_country'];
		$c_age = $_POST['c_age'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_number = $_POST['c_number'];
		move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

		$check_email_query = "select * from customers where customer_email='$c_email'";
		$run_email_query = mysqli_query($con, $check_email_query);
		$rows_email_query = mysqli_num_rows($run_email_query);
			if ($rows_email_query == 0) {
				if (ctype_alpha($c_fname) && ctype_alpha($c_lname)) {
					if (strlen($_POST["c_password"]) >= '8') {
        				if(preg_match("#[0-9]+#",$c_password)) {
        					if(preg_match("#[A-Z]+#",$c_password)) {
        						if (preg_match('/[\'^£$%&!*()}{@#~?><>,|=_+¬-]/', $c_password)) {
									$encrypt_pasword = md5($c_password);		//Encrypting the password into MD5
									$insert_customer = "insert into customers (customer_ip, 
																				customer_fname, 
																				customer_lname, 
																				customer_email, 
																				customer_password, 
																				customer_country, 
																				customer_image, 
																				customer_number, 
																				customer_age) values (
																				'$ip', 
																				'$c_fname', 
																				'$c_lname', 
																				'$c_email', 
																				'$encrypt_pasword', 
																				'$c_country', 
																				'$c_image', 
																				'$c_number', 
																				'$c_age')";
									$run_customer = mysqli_query($con, $insert_customer);
									$_SESSION['customer_email'] = $c_email;
									echo "<script>alert('Registration Successful')</script>";
									echo "<script>window.open('customer/my_account.php', '_self')</script>";
								}else{
									echo "<script>alert('Your Password Must Contain At Least 1 Symbol!')</script>";
								}
							}else{
								echo "<script>alert('Your Password Must Contain At Least 1 Capital Letter!')</script>";
							}
						}else{
							echo "<script>alert('Your Password Must Contain At Least 1 Number!')</script>";
						}
					}else{
						echo "<script>alert('Your Password Must Contain At Least 8 Characters!')</script>";
					}

				}else{
					echo "<script>alert('Name ($c_fname $c_lname) is not alphabetic character!')</script>";
				}
			}else{
				echo "<script>alert('Email ($c_email) is already in use!')</script>";
			}

	}
?>