<?php
if(isset($_POST['login_student'])){
	$regno = $_POST['reg_no'];
	$email = $_POST['email'];
	
	if(validate_form($regno, $email)){
		$query = "SELECT * from students where reg_no='$regno' AND email='$email'";
		
		include 'db_auth.php';
		if($result = mysqli_query($conn, $query)){
			
			if (mysqli_num_rows ( $result ) == 1) {
				session_start ();
				$_SESSION ['reg_no'] = $regno;
				$_SESSION ['email'] = $email;
				
				while($student_details = mysqli_fetch_assoc($result)){
					$_SESSION ['pursuing_course'] = $student_details ['pursuing_course'];
					$_SESSION ['student_category'] = $student_details ['student_category'];
					$_SESSION ['department_id'] = $student_details ['department_id'];
					$_SESSION ['faculty_id'] = $student_details ['faculty_id'];
					$_SESSION ['campus_id'] = $student_details ['campus_id'];
					$_SESSION ['adm_yr'] = $student_details ['adm_yr'];
				}
			}
			echo mysqli_num_rows ( $result );
			
		}
	}
}
function validate_form($regno, $email){
	$form_filled = true;
	if(empty($regno)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing registration number</span><br />';}
	if(empty($email)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing email address</span><br />';}
	return $form_filled;
}
?>
