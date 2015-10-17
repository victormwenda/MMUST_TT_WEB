<?php
if(isset($_POST['add_exam'])){
	
	$exam_type=$_POST['exam_type'];
	$course_code =$_POST['selected_course'];
	$exam_date=$_POST['exam_date'];
	$exam_start=$_POST['exam_start'];
	$exam_duration = $_POST['exam_duration'];
	$exam_room = $_POST['exam_room'];
	
	$student_adm_yr=$_POST['student_adm_yr'];
	$campus_id = $_POST['campus'];
	$faculty_id = $_POST['faculty'];
	$department_id = $_POST['department'];
	$course_id = $_POST['course'];
	
	if(validate_form($course_code,$exam_type,$exam_room,$exam_date,$exam_start,$exam_duration,$campus_id,$faculty_id,$department_id,$student_adm_yr,$course_id)){
	
		include 'db_auth.php';
		$link = $conn;
		
		$query = "INSERT INTO exams values ('$course_code','$department_id','$exam_type','$exam_room','$exam_date','$exam_start','$exam_duration','$faculty_id','$campus_id','$student_adm_yr','$course_id')";
		if(mysqli_query($link, $query)){
			increaseCommits("commits","exams");
			echo "Exam saved successfully<br />";
		}else{ /*Delete file from server*/
			echo "Error saving exam!<br />".mysqli_error($link);
		}
	
	}
	
	
}
function validate_form($course_code,$exam_type,$exam_room,$exam_date,$exam_start,$exam_duration,$campus_id,$faculty_id,$department_id,$student_adm_yr,$course_id){
	$form_filled=true;
	if(empty($course_code)||$course_code==='select_student_course'){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Select course</span><br />';}
	if(empty($exam_type)||$exam_type==='select_exam_type'){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Select exam type</span><br />';}
	if(empty($exam_room)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing exam room</span><br />';}
	if(empty($exam_date)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing exam date</span><br />';}
	if(empty($exam_start)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing exam start time</span><br />';}
	if(empty($exam_duration)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing exam duration</span><br />';}
	
	if(empty($campus_id)||$campus_id=="select_campus"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Campus name.</span><br />';
	}
	if(empty($faculty_id)||$faculty_id==="select_faculty"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Faculty name.</span><br />';
	}
	
	if(empty($department_id)||$department_id=="select_department"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Department name.</span><br />';
	}
	
	if(empty($course_id)||$course_id=="select_course"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing pursuing course.</span><br />';
	}
	if(empty($student_adm_yr)||$student_adm_yr=="student_adm_yr"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Student adm yr.</span><br />';
	}
	
	return $form_filled;
}

function increaseCommits($counter, $tablename){
	include 'db_auth.php';
	$table_commits = getCurrentCommits($tablename) + 1;
	$total_commits = getCurrentCommits($counter) +1;

	$query = "update commits_info set $tablename=".$table_commits.",commits= ".$total_commits;
	if($result = mysqli_query($conn, $query)){

	}
}

function getCurrentCommits($tablename){
	$commits_counter=0;
	include 'db_auth.php';
	$query = "select $tablename from commits_info";
	if($result = mysqli_query($conn,$query)){
		while($commits = mysqli_fetch_assoc($result)){
			$commits_counter = $commits[$tablename];
		}
	}
	return $commits_counter;
}
?>