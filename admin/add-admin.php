<?php
    require '../config/constants.php';
?>

<?php require __DIR__ . '/partials/menu.php';  ?>

<div class="content">
	<div class="wrapper">
		<h1>Add Admin</h1>
		<br><br>

		<?php 

		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		?>

		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Full Name:	</td>
					<td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
				</tr>

				<tr>
					<td>Username:	</td>
					<td><input type="text" name="username" placeholder="Your Username"></td>
				</tr>

				<tr>
					<td>Password:	</td>
					<td><input type="password" name="password" placeholder="Your Password"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>


	</div>
</div>



<?php
	//Process the Value from Form and Save it in Database

	//Check whether the submit button is clicked or not
	
	if(isset($_POST['submit'])){

	//Get the data from Form
		$full_name	= $_POST['full_name'];
		$username 	= $_POST['username'];
		$password	= md5($_POST['password']); 

		//SQL Query to Save data into Database
		$result = $db->col_admin->insertOne([
		    'full_name' => $full_name,
		    'username' => $username,
		    'password' => $password
		]);

		if($result->getInsertedCount() > 0){
			$_SESSION['add'] = "Admin Add Successfully";
			//Redirect page to Manage Admin
			header('location: ./manage-admin.php');
		}else{
			$_SESSION['add'] = "Failed to Add Admin";
			//Redirect page to Manage Admin
			header('location: ./manage-admin.php');
		}
	}
?>

<?php require __DIR__ . '/partials/footer.php';  ?>