<?php
    require '../config/constants.php';
?>

<?php require __DIR__ . '/partials/menu.php';  ?>

<div class="content">
	<div class="wrapper">
		<h1>Manage Food</h1>
		<br>

		<!-- Button to Add Admin -->
		<a href="./add-food.php" class="btn-primary">Add Food</a>
		<br /><br />
		<!-- End Button to Add Admin -->

		<!-- PHP -->
			<?php  

				// add
				if (isset($_SESSION['add'])) 
				{
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}

				// delete
				if (isset($_SESSION['delete'])) 
				{
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}

				// upload
				if (isset($_SESSION['upload'])) 
				{
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}

				// unnauthorize
				if (isset($_SESSION['unnauthorize'])) 
				{
					echo $_SESSION['unnauthorize'];
					unset($_SESSION['unnauthorize']);
				}

			?>
		<!-- End PHP -->

		<!-- Form Food-->
		<form action="" method="POST">
		<table class="tbl-full">

			<tr>
				<th>No.</th>
				<th>Tilte</th>
				<th>Price</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Action</th>
			</tr>

			<!-- Sql Session -->
			<?php  
				$cursor = $db->col_food->find([]);

				if(count($cursor->toArray()) > 0):
					$cursor = $db->col_food->find([]);
					$sn = 1;
					foreach ($cursor as $data):
			?>
						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $data['title']; ?></td>
							<td><?php echo $data['price']; ?></td>
							<td>
								<?php  
									if ($data['image_name']==""):
										echo "<div class='error'>Image Not Add</div>";
									else:
								?>
								<img src="../images/food/<?php echo $data['image_name']; ?>" width="100px">
								<?php
									endif;
								?>
							</td>
							<td><?php echo $data['featured']; ?></td>
							<td><?php echo $data['active']; ?></td>
							<td>
								<a href="./update-food.php?id=<?php echo strval($data['_id']); ?>" class="btn-secondary">Update Food</a>
								<a href="./delete-food.php?id=<?php echo strval($data['_id']);?>&image_name=<?php echo $data['image_name']; ?>" class="btn-danger">Delete Food</a>
							</td>
						</tr>
			<?php
					endforeach;
				else:
					echo "<tr><td colspan='7' class='error'>Food Not Add</td></tr>";
				endif;
			?>
			<!-- End Sql Session -->
		</table>
	</form>
	<!-- End Form Food -->
	</div>
</div>

<?php require __DIR__ . '/partials/footer.php';  ?>