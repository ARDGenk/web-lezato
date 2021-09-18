<?php include('partials/menu.php'); ?>
	
	<!-- Content -->
	<div class="content">
		<div class="wrapper">
		<h1>Manage Admin</h1>
			<br />

			<?php 
		
			if(isset($_SESSION['add'])) //add Admin
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
		
			if(isset($_SESSION['delete'])) //delete Admin
			{
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			}
		
			if(isset($_SESSION['user-not-found']))
			{
				echo $_SESSION['user-not-found'];
				unset($_SESSION['user-not-found']);
			}
		
			if(isset($_SESSION['pwd-not-match']))
			{
				echo $_SESSION['pwd-not-match'];
				unset($_SESSION['pwd-not-match']);
			}
		
			if(isset($_SESSION['change-pwd']))
			{
				echo $_SESSION['change-pwd'];
				unset($_SESSION['change-pwd']);
			}

			if(isset($_SESSION['login']))
			{
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}
		
			?>
			<br><br>

		<!-- Admin -->
		<a href="add-admin.php" class="btn-primary">Add Admin</a>
		<br />
		<!-- End Admin -->

		<table class="tbl-full">
			<tr>
				<th>No.</th>
				<th>Fullname</th>
				<th>Username</th>
				<th>Actions</th>
			</tr>

			<?php 
				//Query to Get All Admin
				$sql = "SELECT * FROM tbl_admin";
				//Execute the Query
				$res = mysqli_query($conn, $sql);
				//Check whether the Query is Executed or Not
				if($res==TRUE)
				{
					// Count Rows to Check whether we have data in database or not
					$rows = mysqli_num_rows($res); //Function to get all the rows in database

					$sn=1; // Create a Variable and Assign the value
					// Check the num of rows
					if($rows)
					{
						// We have data in database
						while($rows=mysqli_fetch_assoc($res))
						{
							// Using while loop to get all data from database
							// And while loop will run as long as we have data in database

							// Get individual data
							$id=$rows['id'];
							$full_name=$rows['full_name'];
							$username=$rows['username'];

							// Display the values in our table
						?>

						<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $full_name; ?></td>
						<td><?php echo $username; ?></td>
						<td>
							<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-danger">Change Password</a>
							<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
							<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
							</td>
						</tr>

						<?php
						
						}
					}
					else
					{
						// We do not data in database
					}
				}

			?>
			<!-- <tr>
						<td>1.</td>
						<td>Ardiansyah Artama</td>
						<td>Ardiansyah</td>
						<td>
							<a href="#" class="btn-secondary">Update Admin</a>
							<a href="#" class="btn-danger">Delete Admin</a>
							</td>
						</tr> -->
		</table>


		<div class="clearfix"></div>
		</div>
		</div>
	</div>
	<!-- Content End -->

<?php include('partials/footer.php'); ?>