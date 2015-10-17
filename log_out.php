<?php
	session_start();
	if(isset($_SESSION['reg_no'])&&isset($_SESSION['email'])){
		session_destroy();
		echo "1";
	}else { echo "0";} 
?>