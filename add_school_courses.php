<?php

if(isset($_POST['add_school_courses'])){
	$course_code=$_POST['course_code'];
	$course_name =$_POST['course_name'];
	
	$campus_id = $_POST['campus'];
	$faculty_id = $_POST['faculty'];
	$department_id = $_POST['department'];
	
	if(validate_form($campus_id,$faculty_id,$department_id,$course_code,$course_name)){
		
		include 'db_auth.php';
		$link = $conn;

		$query = "INSERT INTO school_courses values ('$course_code','$course_name','$department_id','$faculty_id','$campus_id')";
		if(mysqli_query($link, $query)){
			increaseCommits("commits","school_courses");
			echo "School course saved successfully<br />";
		}else{ /*Delete file from server*/
			echo "Error saving school course!<br />".mysqli_error($link);
		}

	}


}

function validate_form($campus_id,$faculty_id,$department_id,$course_code,$course_name){
	$form_filled=true;
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
	if(empty($course_code)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing course code</span><br />';}
	if(empty($course_name)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing course name</span><br />';}
	
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