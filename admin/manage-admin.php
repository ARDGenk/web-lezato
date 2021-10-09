<?php
    require '../config/constants.php';
?>

<?php require __DIR__ . '/partials/menu.php';  ?>
	
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
		<a href="./add-admin.php" class="btn-primary">Add Admin</a>
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
				$cursor = $db->col_admin->find([]);
				if(count($cursor->toArray()) > 0):
					$sn = 1;
					$cursor = $db->col_admin->find([]);
					foreach ($cursor as $data):
			?>
						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $data['full_name']; ?></td>
							<td><?php echo $data['username']; ?></td>
							<td>
								<a href="./update-password.php?id=<?php echo strval($data['_id']); ?>" class="btn-danger">Change Password</a>
								<a href="./update-admin.php?id=<?php echo strval($data['_id']); ?>" class="btn-secondary">Update Admin</a>
								<a href="./delete-admin.php?id=<?php echo strval($data['_id']); ?>" class="btn-danger">Delete Admin</a>
							</td>
						</tr>

			<?php
					endforeach;
				else:
						// We do not data in database
				endif;

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

<?php require __DIR__ . '/partials/footer.php';  ?>