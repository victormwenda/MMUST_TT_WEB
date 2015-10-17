<?php
$host="localhost";
$user="root";
$password="";
$database="MmustTimetable";
	if($conn = mysqli_connect($host, $user, $password, $database)){
		/* echo "connected<br />"; */

	}else{ 
		/* echo "Error ".mysqli_errno($conn)."<br />"; */
	}
?>