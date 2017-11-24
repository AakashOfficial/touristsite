<?php
	
	include("includes/db.php");

	if(isset($_GET['delete_highlights'])){
		$delete_id = $_GET['delete_highlights'];
		$delete_highlights = "delete from highlights where highlight_id = '$delete_id'";
		$run_delete = mysqli_query($con, $delete_highlights);

		if($run_delete){
			echo "<script>alert('A highlight has been deleted!')</script>";
			echo "<script>window.open('index.php?view_highlights', '_self')</script>";
		}

	}

?>