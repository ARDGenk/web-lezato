<?php
    require '../config/constants.php';

    use MongoDB\BSON\ObjectId;
?>

<?php 
	if (isset($_GET['id']) && isset($_GET['image_name']))
	{
		$id = new ObjectId($_GET['id']);
		$image_name = $_GET['image_name'];

		if ($image_name!="") 
		{
			$path = "./../images/food/".$image_name;
			$remove = unlink($path);

			if ($remove==false) 
			{
				$_SESSION['upload'] = "<div class='error'>Failed to remove Image File</div>";
				header('location: ./manage-food.php');
				die();
			}	
		}

		$result = $db->col_food->deleteOne([
			'_id' => $id
		]);

		if($result->getDeletedCount() > 0){
			$_SESSION['delete'] = "<div class='success'>Food Delete Successfuly</div>";
			header('location: ./manage-food.php');
		}else{
			$_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div>";
			header('location: ./manage-food.php');
		}
	}
	else
	{
		$_SESSION['unnauthorize'] = "<div class='error'>Unnauthorize Access</div>";
		header('location: ./manage-food.php');
	}

 ?>