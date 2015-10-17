<?php
$client = $_POST['client'];


require 'db_auth.php';

$reg_no ='SIT/0050/12';//$_POST['reg_no'];
if(true){//isset($_POST['student_info'])
	$query = "SELECT * FROM students WHERE `students`.`reg_no`='$reg_no'";
	}

/*if(session_start()){
	$pursuing_course = $_SESSION ['pursuing_course'];
	$department_id = $_SESSION ['department_id'];
	$faculty_id = $_SESSION ['faculty_id'];
	$campus_id = $_SESSION ['campus_id'];
	$adm_yr = $_SESSION ['adm_yr'];
	
	$query .= " AND `students`.`school_course_id` = '$pursuing_course' AND `students`.`department_id` = '$department_id'
	AND `students`.`faculty_id` = '$faculty_id' AND `students`.`campus_id` = '$campus_id' AND   `students`.`student_adm_yr`= '$adm_yr'";
	
}*/


if($result = mysqli_query($conn, $query)){

	while($students = mysqli_fetch_assoc($result)){
		$student_reg_no= $students['reg_no']; //Not needed...already in session data
		$student_name= $students['full_name'];
		$student_phonenumber = $students['phonenumber'];
		$student_email =$students['email'];
		$student_category = $students['student_category'];
		$student_adm_yr= $students['adm_yr'];
		$student_pursuing_course = $students['pursuing_course'];
		$student_department_id = $students['department_id'];
		$student_faculty_id = $students['faculty_id'];
		$student_campus_id = $students['campus_id'];

		if($client=="desktop")
			showStudents($student_reg_no,$student_name,$student_phonenumber,$student_email,$student_category,$student_adm_yr,
			$student_pursuing_course,$student_department_id,$student_faculty_id,$student_campus_id);
		else{
			echo json_encode(array_map("utf8_encode", $students));
		}
	}
}else{
	echo "Error ".mysqli_error($conn)."<br />";
}

function showStudents($student_reg_no,$student_name,$student_phonenumber,$student_email,$student_category,$student_adm_yr,
			$student_pursuing_course,$student_department_id,$student_faculty_id,$student_campus_id){
			
			//create student info page
			
			}


?>




