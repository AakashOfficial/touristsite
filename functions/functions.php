<?php
	$con = mysqli_connect("localhost", "id500458_sulabh", "@shrestha", "id500458_tourist");
	if (mysqli_connect_errno()) {
		echo "The Connection was not established: " . mysqli_connect_error();
	}
	function getIp() {		//source: php1f.com, getting user's ip address
	    $ip = $_SERVER['REMOTE_ADDR'];
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    return $ip;
	}

	//Creating favourites 
	function favourites(){
		if (isset($_GET['add_favourite'])) {
			if (!isset($_SESSION['customer_email'])) {
				global $con;
				$ip = getIp();		//getting ip address from above function
				$highlight_id = $_GET['add_favourite'];		//getting value from getHigh();
				$check_highlight = "select * from favourites where ip_address='$ip' AND favourite_id = '$highlight_id'";
				$run_check = mysqli_query($con, $check_highlight);
				if (mysqli_num_rows($run_check) > 0) {	//>0 means that the highlight is already listed, preventing duplication;
					echo "";			//so do nothing
				}else{
					// $insert_highlight = "insert into favourites(favourite_id, ip_address) values ('$highlight_id', '$ip')";
					// $run_highlight = mysqli_query($con, $insert_highlight);
					// echo "<script>window.open('pointofinterest.php', '_self')</script>";
					echo "";			//so do nothing
				}
			}else{
				// This is where the coding to save begins
				global $con;
				$ip = getIp();		//getting ip address from above function
				//getting their customer id from session;
				$c_email = $_SESSION['customer_email'];
				$get_email = "select * from customers where customer_email = '$c_email'";
				$run_email = mysqli_query($con, $get_email);
				$row_email = mysqli_fetch_array($run_email);
				$c_id = $row_email['customer_id'];
				$highlight_id = $_GET['add_favourite'];		//getting value from getHigh();
				$check_highlight = "select * from favourites where customer_id='$c_id' AND favourite_id = '$highlight_id'";
				$run_check = mysqli_query($con, $check_highlight);
				if (mysqli_num_rows($run_check) > 0) {	//>0 means that the highlight is already listed, preventing duplication;
					echo "";			//so do nothing
				}else{
					$insert_highlight = "insert into favourites(favourite_id, ip_address, customer_id) values 
																('$highlight_id', '$ip', '$c_id')";
					$run_highlight = mysqli_query($con, $insert_highlight);
					echo "<script>window.open('pointofinterest.php', '_self')</script>";
				}			
			}
		}
	}

	//Getting the total added favourites for your customer page, if only needed
	function total_favourites(){
		if (isset($_GET['add_favourite'])) {
			global $con;
			$ip = getIp();
			$get_favourites = "select * from favourites where ip_address = '$ip'";
			$run_favourites = mysqli_query($con, $get_favourites);
			$count_favourites = mysqli_num_rows($run_favourites);	//has the actual numbers of favurites
		}else{	//when the page starts, the number will be shown via else;
			global $con;
			$ip = getIp();
			$get_favourites = "select * from favourites where ip_address = '$ip'";
			$run_favourites = mysqli_query($con, $get_favourites);
			$count_favourites = mysqli_num_rows($run_favourites);	//has the actual numbers of favurites
		}
		echo $count_favourites;
	}

	//Getting the highlights directly from the database
	function getHighlights(){
		global $con;
		$get_highlights = "select * from highlights";
		$run_highlights = mysqli_query($con, $get_highlights);
		while ($row_highlights = mysqli_fetch_array($run_highlights)) {
			$highlight_id = $row_highlights['highlight_id'];
			$highlight_title = $row_highlights['highlight_name'];
			echo "<li><a href='#'>$highlight_title</a></li>";
		}
	}

	//Getting 6 highlights directly from the database
	function getHigh(){
		if (!isset($_GET['places'])){	//we will create places variable in getPlaces(); //this is done for non-selected
			global $con;
			$get_high = "select * from highlights order by RAND() LIMIT 0, 6";
			$run_high = mysqli_query($con, $get_high);
				echo "
					<section id='portfolio' class='bg-light-gray'>
				        <div class='container'>
					        <div class='row'>
					            <div class='col-lg-12 text-center'>
					                <h2 class='section-heading'>Points of Interests</h2>
					                <h3 class='section-subheading text-muted'>These are some of the points of interest drawn randomly from the many events/highlights.</h3>
					            </div>
					        </div>
				       	</div>
				    </section>
				";
			while ($row_high = mysqli_fetch_array($run_high)) {
				$high_id = $row_high['highlight_id'];
				$high_name = $row_high['highlight_name'];
				$high_address = $row_high['highlight_address'];
				$high_image = $row_high['highlight_image'];
				$high_short_description = $row_high['highlight_short_description'];
				echo "
					<section id='portfolio' class='bg-light-gray'>
				        <div class='container'>
					        <div class='row'>
					            <div class='col-md-4 col-sm-6'>
					                <a href='#'>
					                   	<a href='details.php?high_id=$high_id'><img src='admin_area/highlight_images/$high_image' class='img-responsive' alt=''></a>
					                   	</a>
					                    <div class='places-caption'>
					                        <p class='text-muted'>$high_name</p>
					                        <p class='text-muted'>$high_address</p>
					                    </div>
					            </div>
					                
					            <div class='col-md-8 col-sm-6'>
					                <a href='#'>
					                    <p>$high_short_description</p>
					                </a>
					                <div class='places-caption'>
					                    <p class='text-muted'><a href='pointofinterest.php?add_favourite=$high_id'><button>Add to Favourites</button></a></p>
					                </div>
					            </div>
					        </div>
				       	</div>
				    </section>
						";
					if (isset($_SESSION['customer_email.php'])) {
						echo "You are logged in as a individual user";
					}else{
						echo "You have not logged in! ";
					}
			}
		}
	}

	//get specific places highlights
	function getPlacesHighlights(){
		if (isset($_GET['places'])){	//we will create places variable in getPlaces(); //this is done for non-selected
			$place_id = $_GET['places'];
			global $con;
			$get_places_highlights = "select * from highlights where highlight_address = '$place_id'";
			$run_places_highlights = mysqli_query($con, $get_places_highlights);
			$count_places = mysqli_num_rows($run_places_highlights);	//To check whether the place has got highlights or not
			if ($count_places == 0){
				echo "<h2> There is no Highlights on this exact location </h2>";	
			}

			while ($row_places_highlights = mysqli_fetch_array($run_places_highlights)) {
			$high_id = $row_places_highlights['highlight_id'];
			$high_name = $row_places_highlights['highlight_name'];
			$high_address = $row_places_highlights['highlight_address'];
			$high_image = $row_places_highlights['highlight_image'];
			echo "
				<div>
					<h3>$count_places</h3>
					<h3>$high_name</h3>
					<img src='admin_area/highlight_images/$high_image' width='180' height='180' />
					<p>$high_address</p>
					<a href='details.php?high_id=$high_id'>Substitute it with h3 tag</a>
					<a href='index.php?high_id=$high_id''><button>Add to Favourites</button></a>
				</div>
			";	
			}
		}
	}
?>
