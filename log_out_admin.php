<?php
	session_start();
	if(isset($_SESSION['mmust_admin_username'])&&isset($_SESSION['mmust_admin_password'])){
		session_destroy();
		echo "1";
	}else { echo "0";} 
?>