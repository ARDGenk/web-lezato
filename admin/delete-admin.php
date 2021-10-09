<?php
    require '../config/constants.php';

    use MongoDB\BSON\ObjectId;
?>

<?php 
	$id = new ObjectId($_GET['id']);

	$result = $db->col_admin->deleteOne([
		'_id' => $id
	]);

	if($result->getDeletedCount() > 0){
		$_SESSION['delete'] = "<div class='success'>Admin Deleted Succesfully</div>";
		// Redirect to Manage Admin Page
		header('location: ./manage-admin.php');
	}else{
		$_SESSION['delete'] = "<div class='error'>Failed to Deleted Admin. Try Again Later..</div>";
		header('location: ./manage-admin.php');
	}
?>