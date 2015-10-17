<?php
require 'db_auth.php';
$assessment = $_POST['assessment'];
if(isset($assessment)){
	
	$exam_type = $_POST['assessment'];
	
	$query = "SELECT `courses`.`course_code`,`courses`.`course_name`,`exams`.`exam_type`,`exams`.`exam_room`,`exams`.`exam_date`,`exams`.`exam_start`,`exams`.`exam_duration` FROM courses, exams where`exams`.`course_code`=`courses`.`course_code` and `exams`.`exam_type`='$exam_type'";
	
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
	}
	
	if($assessment==0){
		$query = "SELECT  `courses`.`course_code`,`courses`.`course_name`,`assignments`.`submission_date`,`assignments`.`assignment_no` FROM courses, assignments where`assignments`.`course_code`=`courses`.`course_code`";
		$query .= " AND `courses`.`school_course_code` = '$pursuing_course' AND `courses`.`department_id` = '$department_id'
		AND `courses`.`faculty_id` = '$faculty_id' AND `courses`.`campus_id` = '$campus_id' AND   `courses`.`student_adm_yr`= '$adm_yr'";
	}if($assessment==1||$assessment==2){
		$query .= " AND `exams`.`school_course_code` = '$pursuing_course' AND `exams`.`department_id` = '$department_id'
		AND `exams`.`faculty_id` = '$faculty_id' AND `exams`.`campus_id` = '$campus_id' AND   `exams`.`student_adm_yr`= '$adm_yr'";
	}
	
}



if($result = mysqli_query($conn, $query)){
		
	while($assessments_data = mysqli_fetch_assoc($result)){
		if($assessment==0){
			$course_name = $assessments_data['course_name'];
			$submission_date = $assessments_data['submission_date'];
			$assignment_no = $assessments_data['assignment_no'];
			
			if ($_POST ['client'] == 'desktop') {
				showAssignments ( $course_name, $submission_date, $assignment_no );
			} else {
				echo json_encode(array_map("utf8_encode", $assessments_data)).",";
			}
		}else{
			$course_name = $assessments_data['course_name'];
			$exam_room = $assessments_data['exam_room'];
			$exam_date= $assessments_data['exam_date'];
			$exam_start = $assessments_data['exam_start'];
			$exam_duration= $assessments_data['exam_duration'];
			
			
			if ($_POST ['client'] == 'desktop') {
				showExams($course_name,$exam_room,$exam_date,$exam_start,$exam_duration);
			} else {
				echo json_encode(array_map("utf8_encode", $assessments_data)).",";
			}
		}
	}
}else{
	echo "Error ".mysqli_error($conn)."<br />";
}

function showAssignments($course_name,$submission_date,$assignment_no){
	echo  '<div style="height:70px; box-shadow:rgb(200,200,200) 3px 4px; border-radius:10px; width: 500px; margin:5px; background-color:#eee; z-index:10;">
		<p style="font-family: verdana; padding:10px;">
		<label style="font-size:22px;">' . $course_name . '</label><br />
		<label style="font-size:16px; float:left;">Submission date ' . $submission_date . '</label>
		<label style="font-size:16px; float:right;">' . $assignment_no . '</label>
		</p></div>';
}

function showExams($course_name,$exam_room,$exam_date,$exam_start,$exam_duration){
	echo '<div style="height:70px; box-shadow:rgb(200,200,200) 3px 4px; border-radius:10px; width: 500px; margin:5px; background-color:#eee; z-index:10;">
		<p style="font-family: verdana; padding:10px;">
		<label style="font-size:16px; float:right;">' . $exam_room.'</label>
		<label style="font-size:22px;">' . $course_name . '</label><br />
		<label style="font-size:16px; float:left;">' . $exam_duration . ' hrs</label>
		<label style="font-size:16px; float:right;">' . $exam_start . ' '.$exam_date.'</label>
		</p></div>';
}

?>