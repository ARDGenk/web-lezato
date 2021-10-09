<?php
    require '../config/constants.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Food Order Website - Home Page</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<!-- Menu -->
	<?php require __DIR__ . '/partials/menu.php';  ?>
	<!-- Menu End -->

	<!-- Content -->
	<div class="content">
		<div class="wrapper">
		<h1>DASHBOARD</h1>

		<div class="col-4 text-center">
			<?php  
				$cursor = $db->col_category->find([]);
			?>
			<h1><?php echo count($cursor->toArray()); ?></h1>
			<br />
			Categories
		</div>

		<div class="col-4 text-center">
			<?php  
				$cursor = $db->col_food->find([]);
			?>
			<h1><?php echo count($cursor->toArray()); ?></h1>
			<br />
			Foods
		</div>

		<div class="col-4 text-center">
			<?php  
				$cursor = $db->col_order->find([]);
			?>
			<h1><?php echo count($cursor->toArray()); ?></h1>
			<br />
			Total Orders
		</div>

		<div class="col-4 text-center">
			<?php  
				$collection = $db->col_admin;
				$cursor = $collection->aggregate([
					['$match' => ['status' => 'Delivered']],
					['$group' => ['_id' => '$status', 'Total' => ['$sum' => 1]]]
				]);
			?>
			<?php  
				if(count($cursor->toArray()) > 0):
			?>
				<h1><?php echo $cursor->toArray()[0]['Total']; ?></h1>
				<br />
			<?php
				else:
			?>
				<h1>0</h1>
				<br />		
			<?php
				endif; 
			?>
			Revenue Generated
		</div>

		<div class="clearfix"></div>
		</div>
		</div>
	</div>
	<!-- Content End -->

<?php require __DIR__ . '/partials/footer.php';  ?>