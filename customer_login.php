<?php
	include("includes/db.php");
?>
<div class="container-fluid">
	<form action="" method="post" class="register-form" > 
		<div class="row">
            <h1 id="accountMain">Sign In</h1>   
           	<hr>
		</div>
      	<div class="row">
           	<div class="col-md-4 col-sm-4 col-lg-4">
              	<label for="email">EMAIL</label>
               	<input name="email" class="form-control" type="email" required="required">             
           	</div>            
      	</div>
      	<div class="row">
           	<div class="col-md-4 col-sm-4 col-lg-4">
              	<label for="password">PASSWORD</label>
               	<input name="password" class="form-control" type="password" required="required">             
           	</div>            
     	</div>
      	<hr>
      	<div class="row">
           	<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
           		<button class="btn btn-primary regbutton" name="login" id="customer_registerButton">Login</button>
          	</div>          
      	</div>    
    </form>
</div>

<div>
	<?php
		//Checking the login
		if (isset($_POST['login'])) {
			$c_email = mysql_real_escape_string($_POST['email']);
			$c_password = mysql_real_escape_string($_POST['password']);
			$encrypt_password = md5($c_password);
			$select_customer = "select * from customers where customer_password = '$encrypt_password' AND customer_email = '$c_email'";
			$run_customer = mysqli_query($con, $select_customer);
			$check_customer = mysqli_num_rows($run_customer);
			if ($check_customer == 0) {
				echo "<script>alert('Password or email is incorrect')</script>";
				exit();
			}
			//Checking whether the customer has favourites saved or not
			$c_email = $_POST['email'];
			$get_email = "select * from customers where customer_email='$c_email'";
			$run_email = mysqli_query($con, $get_email);
			$row_email = mysqli_fetch_array($run_email);
			$c_id = $row_email['customer_id'];
			$select_favourites = "select * from favourites where customer_id = '$c_id' ";
			$run_favourites = mysqli_query($con, $select_favourites);
			$check_favourites = mysqli_num_rows($run_favourites); 			//checking the favourites
			if ($check_customer > 0 AND $check_favourites == 0) {			//person has logged in but has no favourites
				$_SESSION['customer_email'] = $c_email;
				echo "<script>alert('Logged in Successfully')</script>";
				echo "<script>window.open('customer/my_account.php', '_self')</script>";
			}else{															//person has logged in  and has favourites
				$_SESSION['customer_email'] = $c_email;
				echo "<script>alert('Logged in Successfully')</script>";
				echo "<script>window.open('favourites.php', '_self')</script>";
			}
		}
	?>
</div>