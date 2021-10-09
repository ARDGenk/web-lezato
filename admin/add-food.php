<?php
    require '../config/constants.php';
?>

<?php require __DIR__ . '/partials/menu.php';  ?>

	<div class="content">
		<div class="wrapper">
			<h1>Add Food</h1>
			<br>

			<?php 

				if (isset($_SESSION['upload'])) 
				{
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}

			?>

			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
				<tr>
				<td>Title: </td>
				<td>
					<input type="text" name="title" placeholder="Food Title">
				</td>
				</tr>
				<tr>
				<td>Description: </td>
				<td>
					<textarea name="description" cols="30" rows="5" placeholder="Descriptionof the food"></textarea>
				</td>
				</tr>

				<tr>
				<td>Price: </td>
				<td>
					<input type="number" name="price">
				</td>
				</tr>	

				<tr>
				<td>Select Image: </td>
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

							if(count($cursor->toArray()) > 0):
								$cursor = $db->col_category->find([
									'active' => 'Yes'
								]);
                    			foreach ($cursor as $data):
						?>
									<option value="<?php echo strval($data['_id']); ?>"><?php echo $data['title']; ?></option>
						<?php
								endforeach;
							else:
						?>
								<option value="0">No Category Found</option>
						<?php
							endif;
						?>
						<option value="1">Food</option>
						<option value="2">Drink</option>
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
				<td colspan="2">
					<input type="submit" name="submit" value="Add Food" class="btn-secondary">
				</td>
				</tr>
				
				</table>
			</form>
		</div>
	</div>

	<?php  

		if (isset($_POST['submit'])) 
		{
			$title = $_POST['title'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$category = $_POST['category'];	

			// Featured & Active Session
			if (isset($_POST['featured'])) 
			{
				$featured = $_POST['featured'];
			}
			else
			{
				$featured = "No";
			}

			if (isset($_POST['active'])) {
				$active = $_POST['active'];
			}
			else
			{
				$active = "No";
			}
			// End Featured & Action Session

			// Image Session
			if (isset($_FILES['image']['name'])){
				$image_name = $_FILES['image']['name'];

				if ($image_name!="") 
				{
					$ext = end(explode('.', $image_name));
					$image_name = "Food-Name-".rand(0000,9999).".".$ext;
					$src = $_FILES['image']['tmp_name'];
					$dst = "../images/food/".$image_name;
					$upload = move_uploaded_file($src, $dst);

					if ($upload==false) 
					{
						$_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
						header('location:'.SITEURL.'admin/add-food.php');
						die();
					}
				}
			}
			else
				$image_name = "";
			$result = $db->col_food->insertOne([
				'title' => $title,
				'description' => $description,
				'price' => $price,
				'image_name' => $image_name,
				'category_id' => $category,
				'featured' => $featured,
				'active' => $active
			]);

			if($result->getInsertedCount() > 0){
				$_SESSION['add'] = "<div class='succes'>Food Add Successfully</div>";
				header('location: ./manage-food.php');
			}else{
				$_SESSION['add'] = "<div class='error'>Failed to Add Food</div>";
				header('location: ./manage-food.php');
			}
		}

	?>

<?php require __DIR__ . '/partials/footer.php'; ?>