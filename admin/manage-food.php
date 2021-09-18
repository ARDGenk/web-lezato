<?php include('partials/menu.php') ?>

<div class="content">
	<div class="wrapper">
		<h1>Manage Food</h1>
		<br>

		<!-- Button to Add Admin -->
		<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
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

				$sql = "SELECT * FROM tbl_food";
				$res = mysqli_query($conn, $sql);
				$sn = 1;
				$count = mysqli_num_rows($res);

					if ($count>0) 
					{
						while ($row=mysqli_fetch_assoc($res)) 
						{
							$id = $row['id'];
							$title = $row['title'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];
							?>

								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td><?php echo $price; ?></td>
									<td>
										<?php  
											if ($image_name=="") 
											{
												echo "<div class='error'>Image Not Add</div>";
											}
											else
											{
												?>
												<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
												<?php
											}
										?>
									</td>
									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td>
										<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
										<a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
									</td>
								</tr>

							<?php
						}
					}
					else
					{
						echo "<tr><td colspan='7' class='error'>Food Not Add</td></tr>";
					}
			?>
			<!-- End Sql Session -->

		</table>
	</form>
	<!-- End Form Food -->

			

	</div>
</div>


<?php include('partials/footer.php') ?>