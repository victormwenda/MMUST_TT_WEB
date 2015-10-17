<?php
	session_start();
	if(isset($_SESSION['reg_no'])&&isset($_SESSION['email'])){
		echo "1";
	}else { echo "0";} 
?>