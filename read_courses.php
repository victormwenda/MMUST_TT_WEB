<?php
require 'db_auth.php';
$query = "SELECT  `courses`.`course_code`,`courses`.`course_name`,`lecturer`.`lec_name`,`lecturer`.`lec_id` FROM courses, lecturer where`lecturer`.`lec_id`=`courses`.`lec_id`";

if ($_POST ['client'] == 'android_mobile') {
		$pursuing_course = $_POST ['pursuing_course'];
		$department_id = $_POST ['department_id'];
		$faculty_id = $_POST ['faculty_id'];
		$campus_id = $_POST ['campus_id'];
		$adm_yr = $_POST ['adm_yr'];
	}
if($_POST ['client'] == 'desktop'&&session_start()){
	$pursuing_course = $_SESSION ['pursuing_course'];
	$department_id = $_SESSION ['department_id'];
	$faculty_id = $_SESSION ['faculty_id'];
	$campus_id = $_SESSION ['campus_id'];
	$adm_yr = $_SESSION ['adm_yr'];

	$query .= " AND `courses`.`school_course_code` = '$pursuing_course' AND `courses`.`department_id` = '$department_id'
	AND `courses`.`faculty_id` = '$faculty_id' AND `courses`.`campus_id` = '$campus_id' AND   `courses`.`student_adm_yr`= '$adm_yr'";

}
if($result = mysqli_query($conn, $query)){
		
	while($courses = mysqli_fetch_assoc($result)){
		$course_name= $courses['course_name'];
		$lec_name= $courses['lec_name'];
		$course_code= $courses['course_code'];
		
		if ($_POST ['client'] == 'desktop') {
			showCourses($course_name,$lec_name,$course_code);
		} else {
			$lec_id= $courses['lec_id'];
			echo json_encode(array_map("utf8_encode", $courses)).",";
		}
		
		
	}
}


function showCourses($course_name,$lec_name,$course_code) {
	echo '<div style="height:70px; box-shadow:rgb(200,200,200) 3px 4px; border-radius:10px; width: 500px; margin:5px; background-color:#eee; z-index:10;">
		<p style="font-family: verdana; padding:10px;">
		<label style="font-size:22px;">' . $course_name . '</label><br />
		<label style="font-size:16px; float:left;">' . $lec_name . '</label>
		<label style="font-size:16px; float:right;">' . $course_code . '</label>
		</p></div>';
	
	
}
?>