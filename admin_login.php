<?php
if(isset($_POST['login_admin'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(validate_form($username, $password)){
		$query = "SELECT username,password from admin where username='$username' AND password='$password' ";
		
		include 'db_auth.php';
		if($result = mysqli_query($conn, $query)){
			
			if (mysqli_num_rows ( $result ) == 1) {
				session_start ();
				$_SESSION ['mmust_admin_username'] = $username;
				$_SESSION ['mmust_admin_password'] = $password;
			}
			echo mysqli_num_rows ( $result );
			
		}
	}
}
function validate_form($username, $password){
	$form_filled = true;
	if(empty($username)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing username</span><br />';}
	if(empty($password)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing password</span><br />';}
	return $form_filled;
}
?>
