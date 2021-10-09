<?php 
	require __DIR__ . '/partials/menu.php';

	require '../config/constants.php';

	use MongoDB\BSON\ObjectId;
?>

	<div class="content">
		<div class="wrapper">
			<h1>Change Password</h1>
			<br><br>

			<?php
				if(isset($_SESSION['change-pwd']))
				{
					echo $_SESSION['change-pwd'];
					unset($_SESSION['change-pwd']);
				}
			?>

			<?php 
				if (isset($_GET['id'])) 
				{
					$id = new ObjectId($_GET['id']);
				}
			?>
			<form action="" method="POST">
				<table class="tbl-30">
					<tr>
						<td>Current Password: </td>
						<td>
							<input type="password" name="current_password" placeholder="Old Password">
						</td>
					</tr>

					<tr>
						<td>New Password: </td>
						<td>
							<input type="password" name="new_password" placeholder="New Password">
						</td>
					</tr>

					<tr>
						<td>Confirm Password: </td>
						<td>
							<input type="password" name="confirm_password" placeholder="Confirm Password">
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo strval($id); ?>">
							<input type="submit" name="submit" value="Change Password" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<?php
		if(isset($_POST['submit'])) 
		{
			$id = new ObjectId($_POST['id']);
			$current_password = md5($_POST['current_password']);
			$new_password = md5($_POST['new_password']);
			$confirm_password = md5($_POST['confirm_password']);

			$cursor = $db->col_admin->findOne([
				'_id' => $id,
				'password' => $current_password
			]);

			if($cursor){
				if($new_password==$confirm_password)
				{
					$result = $db->col_admin->updateOne(
						['_id' => $id],
						['$set' => ['password' => $new_password]]
					);
					if($result->getModifiedCount() > 0)
					{
						$_SESSION['change-pwd'] = "Password Changed Successfuly";
						header('location: ./manage-admin.php');
					}
					else
					{
						$_SESSION['change-pwd'] = "Password did Not Patch";
						header('location: ./manage-admin.php');
					}
				}
				else
				{
					$_SESSION['pwd-not-match'] = "<div class='error'>Password Not Match</div>";
					header('location: ./manage-admin.php');
				}
			}
			else
			{
				$_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
				header('location: ./manage-admin.php');
			}
		}
	?>

<?php require __DIR__ . '/partials/footer.php'; ?>