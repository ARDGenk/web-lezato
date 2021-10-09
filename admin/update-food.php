<?php 
	require __DIR__ . '/partials/menu.php';

	require '../config/constants.php';

	use MongoDB\BSON\ObjectId;
?>

	<?php  
		if(isset($_GET['id']))
		{
			$id = new ObjectId($_GET['id']);

			$cursor = $db->col_food->findOne([
				'_id' => $id
			]);

			$title = $cursor['title'];
			$description = $cursor['description'];
			$price = $cursor['price'];
			$current_image = $cursor['image_name'];
			$current_category = strval($cursor['category_id']);
			$current_featured = $cursor['featured'];
			$current_active = $cursor['active'];
		}
		else
		{
			header('location: ./manage-food.php');
		}
	?>

	<div class="content">
		<div class="wrapper">
			<h1>Update Food</h1>
			<br><br>

			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
					<tr>
						<td>Title: </td>
						<td>
							<input type="text" name="title" value="<?php echo $title; ?>">
						</td>
					</tr>

					<tr>
						<td>Description: </td>
						<td>
							<textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
						</td>
					</tr>

					<tr>
						<td>Price: </td>
						<td>
							<input type="number" name="price" value="<?php echo $price; ?>">
						</td>
					</tr>

					<tr>
						<td>Current Image: </td>
						<td>
							 <?php  
								if($current_image=="")
								{
									echo "<div class='error'>Image Not Available</div>";
								}
								else
								{
									?>
									<img src="./../images/food/<?php echo $current_image; ?>" width="150px">
									<?php
								}
							?>
						</td>
					</tr>

					<tr>
						<td>Select New Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>

					<tr>
						<td>Category: </td>
						<td>
							<select name="category">
								<?php
									$cursor = $db->col_category->find([
										'active' => 'Yes'
									]);

									if(count($cursor->toArray()) > 0){
										$cursor = $db->col_category->find([
											'active' => 'Yes'
										]);
										foreach ($cursor as $data){
											$category_id = strval($data['_id']);
								?>
											<option <?php if($current_category == $category_id) echo "selected"; ?> value="<?php echo $category_id; ?>">
												<?php echo $data['title']; ?>
											</option>
								<?php
										}
									}else{
										echo "<option value='0'>Category Not Available</option>";
									}
								?>

							</select>
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
						<td>
							<input type="hidden" name="id" value="<?php echo strval($id); ?>">
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
							<input type="submit" name="submit" value="Update Food" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
			<?php  
				if (isset($_POST['submit'])) 
				{
					$id = new ObjectId($_POST['id']);
					$title = $_POST['title'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$current_image = $_POST['current_image'];
					$category = $_POST['category'];
					if(isset($_POST['featured']))
						$featured = $_POST['featured'];
					else
						$featured = $current_featured;
					if(isset($_POST['active']))
						$active = $_POST['active'];
					else
						$active = $current_active;

					if (isset($_FILES['image']['name'])) 
					{
						$image_name = $_FILES['image']['name'];	
						
						if ($image_name!="") 
						{
							$tmp = explode('.', $image_name);
							$ext = end($tmp);
							$image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;
							$src_path = $_FILES['image']['tmp_name'];
							$dest_path = "../images/food/".$image_name;
							$upload = move_uploaded_file($src_path, $dest_path);


							if($upload==false)
							{
								$_SESSION['upload'] = "<div class='error'>Failed to Upload New Image</div>";
								header('location: ./manage-food.php');
								die();
							}
							if($current_image!="")
							{
								$remove_path = "../images/food/".$current_image;
								$remove = unlink($remove_path);

								if($remove==false)
								{
									$_SESSION['remove-failed'] = "<div class='error'>Failed to remove current Image</div>";
									header('location: ./manage-food.php');
									die();
								}
							}
						}
						else
						{
							$image_name = $current_image;
						}
					}
					else
					{
						$image_name = $current_image;
					}

					$result = $db->col_food->updateOne(
					[	
						'_id' => $id
					],
					[
						'$set' => [
							'title' => $title,
							'description' => $description,
							'price' => $price,
							'image_name' => $image_name,
							'category_id' => $category,
							'featured' => $featured,
							'active' => $active
						]
					]
					);

					if ($result->getModifiedCount() > 0) 
					{
						$_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
						header('location: ./manage-food.php');
					}
					else
					{
						$_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
						header('location: ./manage-food.php');
					}
					
				}
			?>
		</div>
	</div>

<?php require __DIR__ . '/partials/footer.php'; ?>