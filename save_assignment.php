<?php
if(isset($_POST['add_assignments'])){
	
	$assignment_no=$_POST['assignment_no'];
	$submission_date =$_POST['submission_date'];
	$selected_course=$_POST['selected_course'];

	$campus_id = $_POST['campus'];
	$faculty_id = $_POST['faculty'];
	$department_id = $_POST['department'];
	$course_id = $_POST['course'];
	$student_adm_yr=$_POST['student_adm_yr'];
	
	if(validate_form($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,$assignment_no,$submission_date,$selected_course)){

		include 'db_auth.php';
		$link = $conn;

		$query = "INSERT INTO assignments values ('$selected_course','$submission_date','$assignment_no','$department_id','$student_adm_yr','$faculty_id','$campus_id','$course_id')";
		if(mysqli_query($link, $query)){
			increaseCommits("commits","assignments");
			echo "Assignment saved successfully<br />";
		}else{ /*Delete file from server*/
			echo "Error assignment br />";
		}

	}


}else echo "Cannot save.";

function validate_form($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,$assignment_no,$submission_date,$selected_course){
	$form_filled=true;
	if(empty($campus_id)||$campus_id=="select_campus"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Campus name.</span><br />';}
	if(empty($faculty_id)||$faculty_id==="select_faculty"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Faculty name.</span><br />';}
	if(empty($department_id)||$department_id=="select_department"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Department name.</span><br />';}
	if(empty($course_id)||$course_id=="select_course"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing pursuing course.</span><br />';}
	if(empty($student_adm_yr)||$student_adm_yr=="student_adm_yr"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Student adm yr.</span><br />';}
	
	
	if(empty($assignment_no)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing assignment no.</span><br />';}
	if(empty($submission_date)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing submission date</span><br />';}
	if(empty($selected_course)||$selected_course==='select_course'){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Select course</span><br />';}
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