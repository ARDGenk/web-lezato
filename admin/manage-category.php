<?php
    require '../config/constants.php';
?>

<?php require __DIR__ . '/partials/menu.php';  ?>

<div class="content">
	<div class="wrapper">
		<h1>Manage Category</h1>
		<br><br>

		<?php 
				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}

				if (isset($_SESSION['remove'])) 
				{
					echo $_SESSION['remove'];
					unset($_SESSION['remove']);
				}

				if (isset($_SESSION['delete'])) 
				{
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}

				if (isset($_SESSION['no-found-category'])) 
				{
					echo $_SESSION['no-found-category'];
					unset($_SESSION['no-found-category']);
				}

				if (isset($_SESSION['update'])) 
				{
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}

		?>
		<br><br>
		
		<!-- Button -->
			<a href="./add-category.php" class="btn-primary">Add Category</a>
		<!-- End Button -->

		<table class="tbl-full">
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>

				<?php 
					$cursor = $db->col_category->find();

					$sn=1;

					// Check in Database
					if(count($cursor->toArray()) > 0):
						$cursor = $db->col_category->find();
						foreach ($cursor as $data):
				?>
							<tr>
								<td><?php echo $sn++; ?></td>
								<td><?php echo $data['title']; ?></td>
								<td>
									<?php 
										// Check Image Name
										if ($data['image_name']!=""):
											// Display Image
									?>
											<img src="./../images/category/<?php echo $data['image_name']; ?>" width="100px">

									<?php 
										else:
											// Display Message
											echo "<div class='error'>Image not Add</div>";
										endif;
									?>	
								</td>
								<td><?php echo $data['featured']; ?></td>
								<td><?php echo $data['active']; ?></td>
								<td>
								<a href="./update-category.php?id=<?php echo strval($data['_id']); ?>" class="btn-secondary">Update Category</a>
								<a href="./delete-category.php?id=<?php echo strval($data['_id']); ?>&image_name=<?php echo $data['image_name']; ?>" class="btn-danger">Delete Category</a>
								</td>
							</tr>
				<?php
						endforeach;
					else:
						// Do not Data in Database
						// Display Message
				?>
						<tr>
							<td colspan="6"><div class="error">No Category Add</div></td>
						</tr>
				<?php
					endif;
				?>

		</table>
	</div>
</div>

<?php require __DIR__ . '/partials/footer.php';  ?>