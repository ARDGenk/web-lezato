<?php
    require '../config/constants.php';
?>

<?php require __DIR__ . '/partials/menu.php';  ?>

	<div class="content">
		<div class="wrapper">
			<h1>Add Category</h1>
			<br><br>

			<?php 

			if (isset($_SESSION['add'])) 
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

			if (isset($_SESSION['upload'])) 
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}

			?>

			<!-- Form Category -->
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">

					<tr>
						<td>Title: </td>
						<td>
							<input type="text" name="title" placeholder="Category Title">
						</td>
					</tr>

					<tr>
						<td>Select Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>

					<tr>
						<td>Featured: </td>
						<td>
							<input type="radio" name="featured" value="Yes"> Yes
							<input type="radio" name="featured" value="No"> No
						</td>
					</tr>

					<tr>
						<td>Active: </td>
						<td>
							<input type="radio" name="active" value="Yes"> Yes
							<input type="radio" name="active" value="No"> No
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Category" class="btn-secondary">
						</td>
					</tr>

				</table>
			</form>
			<!-- End Form Category -->

			<?php 
				// Check
				if (isset($_POST['submit'])) 
				{
					// code...
					// echo "Clik";
					// Value from Category Form
					$title = $_POST['title'];

					// Check For Radio Input
					if (isset($_POST['featured'])) 
					{
						// code...
						// Value from Form
						$featured = $_POST['featured'];
					}
					else
					{
						// Default Value
						$featured = "No";
					}

					if (isset($_POST['active'])) 
					{
						// code...
						$active = $_POST['active'];
					}
					else
					{
						$active = "No";
					}

					// Check Image is Selected or Not
					// print_r($_FILES['image']);
					// die();
					if (isset($_FILES['image']['name']))
					 {
						// Upload Image
						$image_name = $_FILES['image']['name'];
						// Auto Rename Image (jpg, png, gif, etc)

						// Upload Image Only if image is selected
						if ($image_name!="") 
						{

						$ext = end(explode('.', $image_name));
						// Rename Image
						$image_name = "Food_Category_".rand(000, 999).'.'.$ext;

						$source_path = $_FILES['image']['tmp_name'];
						$destination_path = "./../images/category/".$image_name;

						// Finally Upload Image
						$upload = move_uploaded_file($source_path, $destination_path);

						// Check Image is Uploaded or Not
						if ($upload==false) 
						{
							// Message
							$_SESSION['upload'] = "<div class='error'>Failed to Upload Image </div>";
							header('location:./add-category.php');
							die();
						}
						}
					}
					else
					{
						// Dont Upload Image
						$image_name = "";
					}

					$result = $db->col_category->insertOne([
						'title' => $title,
					    'image_name' => $image_name,
				        'active' => $active,
				        'featured' => $featured
				    ]);

				    if($result->getInsertedCount() > 0){
				    	$_SESSION['add'] = "<div class='success'>Category Add Successfuly</div>";
						header('location: ./manage-category.php');
				    }else{
				    	$_SESSION['add'] = "<div class='error'>Sorry, Failed to Add Category</div>";
						header('location: ./add-category.php');
				    }
				}
			?>
		</div>
	</div>

<?php require __DIR__ . '/partials/footer.php'; ?>