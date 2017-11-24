<!DOCTYPE html>

<?php
	// Getting the id when the corresponding edit link is clicked
	include ("includes/db.php");
	$h_id = "";
	$h_title = "";
	$h_address = "";
	$h_keyword = "";
	$h_short_description = "";
	$h_description = "";
	if (isset($_GET['edit_highlights'])) {
		$get_id = $_GET['edit_highlights'];
		$get_highlights = "select * from highlights where highlight_id='$get_id'";
		$run_highlights = mysqli_query($con, $get_highlights);
		$row_highlights = mysqli_fetch_array($run_highlights);
		// From that id, all the data is extracted and put as value in the pre-existing form
			$h_id = $row_highlights['highlight_id'];
			$h_title = $row_highlights['highlight_name'];
			$h_address = $row_highlights['highlight_address'];
			$h_image = $row_highlights['highlight_image'];
			$h_keyword = $row_highlights['highlight_keyword'];
			$h_short_description = $row_highlights['highlight_short_description'];
			$h_description = $row_highlights['highlight_description'];
	}
?>

<html>
	<head>
		<title>Update Highlights</title>
	</head>
	<body>
		<form action="edit_highlights.php" method="post" enctype="multipart/form-data" >
			<div class="table-responsive">
				<table align="center" width="750" border="1"  class="table">
					
					<tr align="center" >
						<td colspan="7"><h2>Update Highlights Here</h2></td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight ID: </b></td>
						
						<td><label><?php echo $h_id; ?></label></td>
						<td><input type="text" name="highlight_id" size="60" value="<?php echo $h_id; ?>" hidden ></td>
					</tr>

					<tr>
						<td align="right" ><b>Highlight Name: </b></td>
						<td><input type="text" name="highlight_title" size="60" value="<?php echo $h_title; ?>"></td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Address:</b></td>
						<td>
							<input type="text" name="highlight_address" size="60" value="<?php echo $h_address; ?>" >
						</td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Image:</b></td>
						<td><input type="file" name="highlight_image" > <img src="highlight_images/<?php echo $h_image; ?>" width="50" height="50">  </td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Short Description:</b></td>
						<td>
							<textarea name="highlight_short_description" cols="20" rows="10" ><?php echo $h_short_description; ?></textarea>
						</td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Description:</b></td>
						<td>
							<textarea name="highlight_description" cols="20" rows="10" ><?php echo $h_description; ?></textarea>
						</td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Keyword:</b></td>
						<td><input type="text" name="highlight_keyword" size="60" value="<?php echo $h_keyword; ?>" ></td>
					</tr>
					<tr align="center" >
					
						<td colspan="7" ><input type="submit" name="update_post" value="Update Highlight's"></td>
					</tr>

				</table>
			</div>
		</form>
	</body>
</html>

<?php

	if (isset($_POST['update_post']) ) {
		$highlight_id = $_POST['highlight_id'];			
		$highlight_title = $_POST['highlight_title'];
		$highlight_address = $_POST['highlight_address'];
		$highlight_short_description = $_POST['highlight_short_description'];
		$highlight_description = $_POST['highlight_description'];
		$highlight_keyword = $_POST['highlight_keyword'];
		$highlight_image = $_FILES['highlight_image']['name']; 
		$highlight_image_tmp = $_FILES['highlight_image']['tmp_name'];
		move_uploaded_file($highlight_image_tmp, "highlight_images/$highlight_image"); 

		$update_highlights = "update highlights set highlight_name = '$highlight_title', 
													highlight_address = '$highlight_address',
													highlight_image = '$highlight_image',
													highlight_keyword = '$highlight_keyword',
													highlight_description = '$highlight_description',
													highlight_short_description = '$highlight_short_description'
													where highlight_id = '$highlight_id'";

		$run_high = mysqli_query($con, $update_highlights);

		if ($run_high) {
			echo "<script>alert('Highlights has been updated')</script>";
			echo "<script>window.open('index.php?view_highlights', '_self')</script>";
		}else{
			echo "<script>alert('Highlights has not been updated')</script>";
		}
	}

?>
