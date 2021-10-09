<?php 
	require __DIR__ . '/partials/menu.php';

	require '../config/constants.php';

	use MongoDB\BSON\ObjectId;
?>
	<div class="content">
		<div class="wrapper">
			<h1>Update Category</h1>
			<br><br>

			<?php  

				if (isset($_GET['id'])) 
				{
					$id = new ObjectId($_GET['id']);
					$cursor = $db->col_category->findOne([
						'_id' => $id
					]);

					if ($cursor) 
					{
						$title = $cursor['title'];
						$current_image = $cursor['image_name'];
						$featured = $cursor['featured'];
						$active = $cursor['active'];	
					}
					else
					{
						$_SESSION['no-found-category'] = "<div class='error'>Category Not Found</div>";
						header('location: ./manage-category.php');
					}
				}
				else
				{
					header('location: ./manage-category.php');
				}

			?>

			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">

					<tr>
						<td>Title: </td>
						<td>
							<input type="text" name="title" value="<?php echo $title; ?>">
						</td>
					</tr>

					<tr>
						<td>Current Image: </td>
						<td>
							<?php  

							if ($current_image !="") 
							{
								?>
									<img src="./../images/category/<?php echo $current_image; ?>" width="150px">
								<?php
							}
							else
							{
								echo "<div class='error'>Image Not Added</div>";
							}

							?>
						</td>
					</tr>

					<tr>
						<td>New Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>

					<tr>
						<td>Featured: </td>
						<td>
							<input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
							<input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
						</td>
					</tr>

					<tr>
						<td>Active: </td>
						<td>
							<input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
							<input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
						</td>
					</tr>

					<tr>
						<td>
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
						<input type="hidden" name="id" value="<?php echo strval($id); ?>">
						<input type="submit" name="submit" value="Update Category" class="btn-secondary">
						</td>
					</tr>

				</table>	
			</form>

			<?php  

				if (isset($_POST['submit'])) 
				{
					$id = new ObjectId($_POST['id']);
					$title = $_POST['title'];
					$featured = $_POST['featured'];
					$active = $_POST['active'];

					if (isset($_FILES['image']['name']))
					{
						// Upload Image
						$new_image = $_FILES['image']['name'];
						// Auto Rename Image (jpg, png, gif, etc)

						// Upload Image Only if image is selected
						if ($new_image!="") 
						{
							$tmp = explode('.', $new_image);
							$ext = end($tmp);
							// Rename Image
							$new_image = "Food_Category_".rand(000, 999).'.'.$ext;

							$source_path = $_FILES['image']['tmp_name'];
							$destination_path = "./../images/category/".$new_image;

							// Finally Upload Image
							$upload = move_uploaded_file($source_path, $destination_path);

							
							// Check Image is Uploaded or Not
							if ($upload==false) 
							{
								// Message
								$_SESSION['upload'] = "<div class='error'>Failed to Upload Image </div>";
								header('location:./add-category.php');
								die();
							}else{
								unlink('./../images/category/' . $current_image);
							}
						}else
						{
							// Dont Upload Image
							$new_image = $current_image;
						}
					}


					$result = $db->col_category->updateOne(
						['_id' => $id],
						['$set' => [
							'title' => $title,
							'image_name' => $new_image,
							'featured' => $featured,
							'active' => $active
						]] 
					);


					if ($result->getModifiedCount() > 0) 
					{
						$_SESSION['update'] = "<div class='success'>Update Category Successfully</div>";
						header('location: ./manage-category.php');
					}
					else
					{
						$_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
						header('location: ./manage-category.php');
						// die();
					}
				}

			?>

		</div>
	</div>

<?php require __DIR__ . '/partials/footer.php'; ?> 