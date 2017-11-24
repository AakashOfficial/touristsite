<!DOCTYPE html>
<?php
	include ("includes/db.php");
?>

<html>
	<head>
		<title>Inserting Highlights</title>
	</head>
	<body>
		<form action="insert_highlights.php" method="post" enctype="multipart/form-data" >	<!-- enctype for various form's of data -->
			<div class="table-responsive" >
				<table align="center" width="750" border="1" class="table" >
					
					<tr align="center" >
						<td colspan="7"><h2>Insert New Highlights Here</h2></td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Name:</b></td>
						<td><input type="text" name="highlight_title" size="60" required></td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Address:</b></td>
						<td>
							<input type="text" name="highlight_address" size="60" required >
						</td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Image:</b></td>
						<td><input type="file" name="highlight_image" required></td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Short Description:</b></td>
						<td>
							<textarea name="highlight_short_description" cols="20" rows="10"></textarea>
						</td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Description:</b></td>
						<td>
							<textarea name="highlight_description" cols="20" rows="10"></textarea>
						</td>
					</tr>
					<tr>
						<td align="right" ><b>Highlight Keyword:</b></td>
						<td><input type="text" name="highlight_keyword" size="60" required ></td>
					</tr>

					<tr align="center" >
						<td colspan="7" ><input type="submit" name="insert_post" value="Insert Highlight's"></td>
					</tr>

				</table>
			</div>
		</form>
	</body>
</html>

<?php

	if (isset($_POST['insert_post'])) {
		//getting the text data from the fields
		$highlight_title = $_POST['highlight_title'];
		$highlight_address = $_POST['highlight_address'];
		$highlight_short_description = $_POST['highlight_short_description'];
		$highlight_description = $_POST['highlight_description'];
		$highlight_keyword = $_POST['highlight_keyword'];

		//getting the image from the fields
		$highlight_image = $_FILES['highlight_image']['name']; //['name'], we only need the name;
		$highlight_image_tmp = $_FILES['highlight_image']['tmp_name']; //['tmp_name'], for copying the image name;
		move_uploaded_file($highlight_image_tmp, "highlight_images/$highlight_image"); //(temporary filename, destination)

		$insert_highlights = "insert into highlights (highlight_name, 
														highlight_address, 
														highlight_image, 
														highlight_keyword, 
														highlight_description, 
														highlight_short_description) values(
														'$highlight_title', 
														'$highlight_address', 
														'$highlight_image', 
														'$highlight_keyword', 
														'$highlight_description', 
														'$highlight_short_description'
														)";

		$insert_high = mysqli_query($con, $insert_highlights);
		if ($insert_high) {
			echo "<script>alert('Highlights Has Been Inserted!')</script>";
			echo "<script>window.open('index.php?insert_highlights', '_self')</script>";
		}
	}

?>
