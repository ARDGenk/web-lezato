<?php
	session_start();
    require '../config/constants.php';

    use MongoDB\BSON\ObjectId;
?>

<?php 
	if (isset($_GET['id']) AND isset($_GET['image_name'])) 
	{
		$id = new ObjectId($_GET['id']);
		$image_name = $_GET['image_name'];

		if ($image_name != "") 
		{
			$path = "./../images/category/".$image_name;
			$unlink = unlink($path);

			if ($remove==false) 
			{
				$_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
				header('location: ./manage-category.php');
				die();
			}
		}
		$result = $db->col_category->deleteOne([
			'_id' => $id
		]);

		if($result->getDeletedCount() > 0){
			$_SESSION['delete'] = "<div class='succes'>Category Deleted Successfully</div>";
			header('location: ./manage-category.php');
		}else{
			$_SESSION['delete'] = "<div class='error'>Failed to Deleted Category</div>";
			header('location: ./manage-category.php');
		}
	}
	else
	{
		header('location: ./manage-category.php');
	}

?>