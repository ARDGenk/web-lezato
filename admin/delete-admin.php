<?php 

	// Include constants.php 
	include('../config/constants.php');

	// Get the ID of admin to be deleted
	$id = $_GET['id'];

	// Create SQL Query to delete admin
	$sql = "DELETE FROM tbl_admin WHERE id=$id";
	
	// Execute the Query
	$res = mysqli_query($conn, $sql);

	// Check whether the query execute succesfully or not
	if($res==true)
	{
		// Query Execute Succesfully and Admin Deleted
		// echo "Admin Deleted";
		// Create session variable to Display Message
		$_SESSION['delete'] = "<div class='success'>Admin Deleted Succesfully</div>";
		// Redirect to Manage Admin Page
		header('location:'.SITEURL.'admin/manage-admin.php');
	} 
	else
	{
		// Failed to Deleted Admin
		// echo "Failed to Deleted Admin";
		$_SESSION['delete'] = "<div class='error'>Failed to Deleted Admin. Try Again Later..</div>";
		header('location:'.SITEURL.'admin/manage-admin.php');
	}

	// Redirect to Manage Admin page with message (succes)

?>