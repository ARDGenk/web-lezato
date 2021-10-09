<?php  
	require __DIR__ . '/../vendor/autoload.php';

	$koneksi = new MongoDB\Client(
	    'mongodb+srv://ARDGenk:Ammarjie500@cluster0.ewfyj.mongodb.net/myFirstDatabase?retryWrites=true&w=majority' 
	);
	
	$db = $koneksi->ARDGenk;
?>