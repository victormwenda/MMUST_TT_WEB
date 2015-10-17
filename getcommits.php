<?php
	require 'db_auth.php';
	$query = "SELECT * FROM commits_info";
	if($result = mysqli_query($conn, $query)){
		while($array_data = mysqli_fetch_assoc($result)){
			$json_array [] = array_map("utf8_encode", $array_data) ;
			echo json_encode($json_array);
		}
	}
?>