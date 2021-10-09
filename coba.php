<?php 
	require __DIR__ . '/vendor/autoload.php';

	use MongoDB\BSON\ObjectId;

	$koneksi = new MongoDB\Client(
	    'mongodb+srv://ARDGenk:Ammarjie500@cluster0.ewfyj.mongodb.net/myFirstDatabase?retryWrites=true&w=majority' 
	);
	$id = new ObjectId('61601702294c0000bc007d72');
	$db = $koneksi->ARDGenk;
	// $collection = $koneksi->selectCollection($db, 'colAdmin');

	$result = $db->col_admin->updateOne(
				['_id' => $id],
				['$set' => ['full_name' => 'kyoo', 'username' => 'kyoontol2']]
			);

	print_r($result->getModifiedCount())
?>