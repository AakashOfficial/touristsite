<?php 
	if (!isset($_SESSION['user_email'])) {
		echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
	}else{
?>
<div class="table-responsive" >
	<h2 id="view1" >View All Highlights Here</h2>
	<table width="795" align="center" class="table" >
		<tr>
			<th>S. No.</th>
			<th>Highlight Name</th>
			<th>Address</th>
			<th>Image</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

		<?php 
			// Getting all the Data from the table Highlights
			include ("includes/db.php");
			$get_highlights = "select * from highlights";
			$run_highlights = mysqli_query($con, $get_highlights);
			$i = 0;	//For Calculating the S.No
			while ($row_highlights = mysqli_fetch_array($run_highlights)) {
				$h_id = $row_highlights['highlight_id'];
				$h_title = $row_highlights['highlight_name'];
				$h_address = $row_highlights['highlight_address'];
				$h_image = $row_highlights['highlight_image'];
				$i++;
		?>

		<tr>
			<th><?php echo $i; ?></th>
			<th><?php echo $h_title; ?></th>
			<th><?php echo $h_address; ?></th>
			<th><img src="highlight_images/<?php echo $h_image; ?>" width="50" height="50" /></th>
			<th><a href="index.php?edit_highlights=<?php echo $h_id; ?>">Edit</a></th>
			<th><a href="delete_highlights.php?delete_highlights=<?php echo $h_id; ?>">Delete</a></th>
		</tr>

		<?php } ?>	<!-- Closing of the while loop -->

	</table>
</div>
<?php } ?>