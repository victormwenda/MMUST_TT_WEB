<?php


if(isset($_POST['add_class'])){
	$selected_course=$_POST['selected_course'];
	$campus_id = $_POST['campus'];
	$faculty_id = $_POST['faculty'];
	$department_id = $_POST['department'];
	$course_id = $_POST['course'];
	$student_adm_yr=$_POST['student_adm_yr']; 
	
	$course_code =$_POST['selected_course'];
	$selected_lec=$_POST['selected_lec'];
	$class_room = $_POST['class_room'];

	$monday = "0";
	$tuesday = "0";
	$wednesday = "0";
	$thursday = "0";
	$friday = "0";
	

	if(!empty($_POST['monday_start'])||!empty($_POST['monday_stop'])){
		$monday = "1";
		$monday_start = $_POST['monday_start'];
		$monday_stop= $_POST['monday_stop'];
	}
	
	if(!empty($_POST['tuesday_start'])||!empty($_POST['tuesday_stop'])){
		$tuesday = "1";
		$tuesday_start = $_POST['tuesday_start'];
		$tuesday_stop= $_POST['tuesday_stop'];
	}
	
	if(!empty($_POST['wednesday_start'])||!empty($_POST['wednesday_stop'])){
		$wednesday = "1";
		$wednesday_start = $_POST['wednesday_start'];
		$wednesday_stop= $_POST['wednesday_stop'];
	}
	
	if(!empty($_POST['thursday_start'])||!empty($_POST['thursday_stop'])){
		$thursday = "1";
		$thursday_start = $_POST['thursday_start'];
		$thursday_stop= $_POST['thursday_stop'];
	}
	
	if(!empty($_POST['friday_start'])||!empty($_POST['friday_stop'])){
		$friday = "1";
		$friday_start = $_POST['friday_start'];
		$friday_stop= $_POST['friday_stop'];
	}
	
	
	if(@validate_form($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,
			$selected_course,$selected_lec,$class_room,
			$monday,$monday_start,$monday_stop,
			$tuesday ,$tuesday_start,$tuesday_stop,
			$wednesday ,$wednesday_start ,$wednesday_stop,
			$thursday,$thursday_start,$thursday_stop,
			$friday,$friday_start,$friday_stop)){

		include 'db_auth.php';
				
		if($monday=="1"){ $class_days="1";
			$sql = "INSERT INTO classes values ('$selected_course','$selected_lec','$class_room','$monday_start','$monday_stop','$class_days','$student_adm_yr','$department_id','$faculty_id','$campus_id','$course_id')";
			if(mysqli_query($conn, $sql)){
				echo '<span style="color:#00FF00;font-family:monospace;" >Monday class added successfully</span><br />';
			}else{ echo '<span style="color:#00FF00;font-family:monospace;" >Error adding monday classes</span><br />';}
			
		}
		if($tuesday=="1"){ $class_days="2";
			$sql = "INSERT INTO classes values ('$selected_course','$selected_lec','$class_room','$tuesday_start','$tuesday_stop','$class_days','$student_adm_yr','$department_id','$faculty_id','$campus_id','$course_id')";
		
			if(mysqli_query($conn, $sql)){
				echo '<span style="color:#00FF00;font-family:monospace;" >Tuesday class added successfully</span><br />';
			}else{ echo '<span style="color:#00FF00;font-family:monospace;" >Error adding tuesday classes</span><br />';}
		}
		if($wednesday=="1"){ $class_days="3";
			$sql = "INSERT INTO classes values ('$selected_course','$selected_lec','$class_room','$wednesday_start','$wednesday_stop','$class_days','$student_adm_yr','$department_id','$faculty_id','$campus_id','$course_id')";
			if(mysqli_query($conn, $sql)){
				echo '<span style="color:#00FF00;font-family:monospace;" >Wednesday class added successfully</span><br />';
			}else{ echo '<span style="color:#00FF00;font-family:monospace;" >Error adding wednesday classes</span><br />';}
		}
		if($thursday=="1"){$class_days="4";
			$sql = "INSERT INTO classes values ('$selected_course','$selected_lec','$class_room','$thursday_start','$thursday_stop','$class_days','$student_adm_yr','$department_id','$faculty_id','$campus_id','$course_id')";
			if(mysqli_query($conn, $sql)){
				echo '<span style="color:#00FF00;font-family:monospace;" >Thursday class added successfully</span><br />';
			}else{ echo '<span style="color:#00FF00;font-family:monospace;" >Error adding thursday classes</span><br />';}
		}
		if($friday=="1"){$class_days="5";
			$sql = "INSERT INTO classes values ('$selected_course','$selected_lec','$class_room','$friday_start','$friday_stop','$class_days','$student_adm_yr','$department_id','$faculty_id','$campus_id','$course_id')";
			if(mysqli_query($conn, $sql)){
				echo '<span style="color:#00FF00;font-family:monospace;" >Friday class added successfully</span><br />';
			}else{ echo '<span style="color:#00FF00;font-family:monospace;" >Error adding friday classes</span><br />';}
		}
		
		increaseCommits("commits","classes");
	}
}

function validate_form($campus_id,$faculty_id,$department_id,$course_id,$student_adm_yr,$selected_course,$selected_lec,$class_room,$monday,$monday_start,$monday_stop,$tuesday ,$tuesday_start,$tuesday_stop,$wednesday ,$wednesday_start ,$wednesday_stop,$thursday,$thursday_start,$thursday_stop,$friday,$friday_start,$friday_stop){
	$form_filled = true;
	
	if(empty($campus_id)||$campus_id=="select_campus"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Campus name.</span><br />';}
	if(empty($faculty_id)||$faculty_id==="select_faculty"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Faculty name.</span><br />';}
	if(empty($department_id)||$department_id=="select_department"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Department name.</span><br />';}
	if(empty($course_id)||$course_id=="select_course"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Pursuing course name.</span><br />';}
	if(empty($student_adm_yr)||$student_adm_yr=="student_adm_yr"){$form_filled = false;echo '<span style="color:#FF0000;font-family:monospace;" >Missing Student adm yr.</span><br />';}
	
	if(empty($selected_course)||$selected_course==="select_student_course"){
		$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Select course.</span><br />';
	}
	if(empty($selected_lec)||$selected_lec==="select_lec"){
		$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Select lecturer.</span><br />';
	}
	if(empty($class_room)){
		$form_filled = false; echo '<span style="color:#FF0000;font-family:monospace;" >Select classroom.</span><br />';
	}
	
	
	if(day_selected($monday,$tuesday,$wednesday,$thursday,$friday)){
		if(!empty($monday)){
		
			if(empty($monday_start)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter monday class start time</span><br />';}
			if(empty($monday_stop)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter monday class stop time</span><br />';}
		}
		if(!empty($tuesday)){
		
			if(empty($tuesday_start)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter tuesday class start time</span><br />';}
			if(empty($tuesday_stop)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter tuesday class stop time</span><br />';}
		}
		if(!empty($wednesday)){
		
			if(empty($wednesday_start)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter wednesday class start time</span><br />';}
			if(empty($wednesday_stop)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter wednesday class stop time</span><br />';}
		}
		if(!empty($thursday)){
		
			if(empty($thursday_start)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter thursday class start time</span><br />';}
			if(empty($thursday_stop)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter thursday class stop time</span><br />';}
		}
		if(!empty($friday)){
		
			if(empty($friday_start)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter friday class start time</span><br />';}
			if(empty($friday_stop)){$form_filled = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Enter friday class stop time</span><br />';}
		}
		
		
	}else{
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Select a day</span><br />';
	}
	return $form_filled;
}

function day_selected($monday,$tuesday,$wednesday,$thursday,$friday){
	$day_selected = false;
	
	if($monday=="1"){ 
		$day_selected = true;
	}
	if($tuesday=="1"){ 
		$day_selected = true;
	}
	if($wednesday=="1"){
		$day_selected = true;
	}
	if($thursday=="1"){ 
		$day_selected = true;
	}
	if($friday=="1"){
		$day_selected = true;
	}
	return $day_selected;
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