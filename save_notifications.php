<?php
if(isset($_POST['add_notification'])){
	$notification_id="NTF_".rand(0,999); 
	$notification_title =$_POST['n_title'];
	$notification_message =$_POST['n_message'];
	$notification_sender =$_POST['n_sender'];
	$notification_send_time = time();
	
	$cb_campuses="0";
	$cb_faculties="0";
	$cb_departments="0";
	$cb_courses="0";
			
	if(isset($_POST['cb_campuses'])){$cb_campuses=$_POST['cb_campuses'];}
	if(isset($_POST['cb_faculties'])){$cb_faculties=$_POST['cb_faculties'];}
	if(isset($_POST['cb_departments'])){$cb_departments=$_POST['cb_departments'];}
	if(isset($_POST['cb_courses'])){$cb_courses=$_POST['cb_courses'];}
	
	$campus_id = $_POST['campus'];
	$faculty_id = $_POST['faculty'];
	$department_id = $_POST['department'];
	$course_id = $_POST['course'];
	$student_adm_yr = $_POST['student_adm_yr'];
	
	if(validate_form($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,$notification_title,$notification_message,$notification_sender)){
	
			include 'db_auth.php';
			$link = $conn;		
			
			if($cb_campuses=="true"){$campus_id="ALL";}
			if($cb_faculties=="true"){$faculty_id="ALL";}
			if($cb_departments=="true"){$department_id="ALL";}
			if($cb_courses=="true"){$course_id="ALL";}
			
		
			$query = "INSERT INTO notifications values ('$notification_id','$notification_title','$notification_message','$notification_send_time','$notification_sender','$department_id','$faculty_id','$campus_id','$student_adm_yr','$course_id')";
			if(mysqli_query($link, $query)){
				increaseCommits("commits","notifications");
				echo "Notification added successfully<br />";
			}else{ /*Delete file from server*/
				echo "Error adding notification!<br />";
			}
	
	}


}

function validate_form($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,$notification_title,$notification_message,$notification_sender){
	$form_filled=true;
	if(empty($campus_id)||$campus_id=="select_campus"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Campus name.</span><br />';}
	if(empty($faculty_id)||$faculty_id==="select_faculty"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Faculty name.</span><br />';}
	if(empty($department_id)||$department_id=="select_department"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Department name.</span><br />';}
	if(empty($course_id)||$course_id=="select_course"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing pursuing course.</span><br />';}
	if(empty($student_adm_yr)||$student_adm_yr=="student_adm_yr"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Student adm yr.</span><br />';}
	
	if(empty($notification_title)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing notification title</span><br />';}
	if(empty($notification_message)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing notification message</span><br />';}
	if(empty($notification_sender)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing notification sender</span><br />';}
	
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