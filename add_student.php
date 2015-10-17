<?php
if(isset($_POST['add_student'])){
	
	$reg_no = $_POST['reg_no'];
	$full_name = $_POST ['full_name'];
	$pursuing_course ="";
	$phonenumber = $_POST ['phonenumber'];
	$email = $_POST ['email'];
	$student_category = $_POST ['student_category'];
	
	$campus_id = $_POST['campus'];
	$faculty_id = $_POST['faculty'];
	$department_id = $_POST['department'];
	$course_id = $_POST['course'];
	$student_adm_yr=$_POST['student_adm_yr'];
	
	$pursuing_course = $course_id;
	
	if(validateStudent($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,$reg_no,$full_name,$pursuing_course,$phonenumber,$email,$student_category)){
		
		$query ="insert into students values ('$reg_no','$full_name','$pursuing_course','$department_id','$phonenumber','$email','$student_category','$student_adm_yr','$faculty_id','$campus_id');";
		
		include 'db_auth.php';
		if(mysqli_query($conn, $query)){
			increaseCommits("commits","students");
			echo "Student added successfully<br />";
		}else echo '<span style="color:#FF0000;">Error. Student could not be added.</span><br />';
	}
}else{ echo "NOT SET";}
 
 


function validateStudent($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,$reg_no,$full_name,$pursuing_course,$phonenumber,$email,$student_category){
	$form_filled = true;
	if(empty($campus_id)||$campus_id=="select_campus"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Campus name.</span><br />';}
	if(empty($faculty_id)||$faculty_id==="select_faculty"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Faculty name.</span><br />';}
	if(empty($department_id)||$department_id=="select_department"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Department name.</span><br />';}
	if(empty($course_id)||$course_id=="select_course"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Department name.</span><br />';}
	if(empty($student_adm_yr)||$student_adm_yr=="student_adm_yr"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Student adm yr.</span><br />';}
	
	if(empty($reg_no)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing student registration number</span><br />';}
	if(empty($full_name)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing student name</span><br />';}
	if(empty($pursuing_course)||$pursuing_course==='select_course'){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing pursuing course.</span><br />';}
	if(empty($phonenumber)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing phonenumber</span><br />';}
	if(empty($email)){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing email address</span><br />';}
	if(empty($student_category)||$student_category==='student_category'){$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Select student category</span><br />';}
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
 