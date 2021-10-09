<?php 
	require __DIR__ . '/partials/menu.php';

	require '../config/constants.php';

	use MongoDB\BSON\ObjectId;
?>

	<div class="content">
		<div class="wrapper">
			<h1>Update Admin</h1>
			<br><br>

			<?php 

			if(isset($_SESSION['up']))
			{
				echo $_SESSION['up'];	
				unset($_SESSION['up']);
			}

			?>
			<?php
				$id= new ObjectId($_GET['id']);

				$cursor = $db->col_admin->findOne([
					'_id' => $id
				]);

				if($cursor){
					$full_name = $cursor['full_name'];
					$username = $cursor['username'];
				}else
					header('location: ./manage-admin.php');
			?>

			<form action="" method="POST">
				<table class="tbl-30">
					<tr>
						<td>Fullname: </td>
						<td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
					</tr>

					<tr>
						<td>Username: </td>
						<td><input type="text" name="username" value="<?php echo $username; ?>"></td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo strval($id); ?>">
							<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<?php

		if(isset($_POST['submit']))
		{
			 // echo "Button Clicked";
			$id = new ObjectId($_POST['id']);
			$full_name = $_POST['full_name'];
			$username = $_POST['username'];

			$result = $db->col_admin->updateOne(
				['_id' => $id],
				['$set' => [
					'full_name' => $full_name,
					'username' => $username
				]]
			);
			

			if($result->getModifiedCount() > 0)
			{
				$_SESSION['up'] = "<div class='success'>Admin Update Successfuly</div>";
				header('location: ./manage-admin.php');
				// return true;
			}
			else
			{
				$_SESSION['up'] = "<div class='error'>Failed to Update Admin</div>";
				header('location: ./manage-admin.php');
				// return false;
			}
		}

	?>

<?php require __DIR__ . '/partials/footer.php'; ?>