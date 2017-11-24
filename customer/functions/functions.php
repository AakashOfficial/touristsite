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

	//creating favourites
	function favourites(){
		if (isset($_GET['add_favourite'])) {
			global $con;

			$ip = getIp();		//getting ip address from above function
			$highlight_id = $_GET['add_favourite'];		//getting value from getHigh();
			
			$check_highlight = "select * from favourites where ip_address='$ip' AND favourite_id = '$highlight_id'";

			$run_check = mysqli_query($con, $check_highlight);

			if (mysqli_num_rows($run_check) > 0) {	//>0 means that the highlight is already listed
				echo "";			//so do nothing
			}else{
				$insert_highlight = "insert into favourites(favourite_id, ip_address) values ('$highlight_id', '$ip')";
				$run_highlight = mysqli_query($con, $insert_highlight);

				echo "<script>window.open('pointofinterest.php', '_self')</script>";

			}

		}
	}

	//getting the total added favourites
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

	//getting the places
	function getPlaces(){

		global $con;

		$get_places = "select * from places";

		$run_places = mysqli_query($con, $get_places);

		while ($row_places = mysqli_fetch_array($run_places)) {
			$place_id = $row_places['place_id'];
			$place_title = $row_places['place_name'];

			echo "<li><a href='pointofinterest.php?places=$place_id'>$place_title</a></li>";
		}

	}


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

	function getHigh(){

		if (!isset($_GET['places'])){	//we will create places variable in getPlaces(); //this is done for non-selected

		global $con;
		$get_high = "select * from highlights order by RAND() LIMIT 0, 6";

		$run_high = mysqli_query($con, $get_high);

		while ($row_high = mysqli_fetch_array($run_high)) {
			$high_id = $row_high['highlight_id'];
			$high_name = $row_high['highlight_name'];
			$high_address = $row_high['highlight_address'];
			$high_image = $row_high['highlight_image'];

			echo "
				<div>
					<h3>$high_name</h3>
					<img src='admin_area/highlight_images/$high_image' width='180' height='180' />
					<p>Address: $high_address</p>
					<a href='details.php?high_id=$high_id'>Substitute it with h3 tag</a>
					<a href='pointofinterest.php?add_favourite=$high_id''><button>Add to Favourites</button></a>
				</div>
			";

		}
	}

	}


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
