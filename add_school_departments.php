<?php 
if(isset($_POST['add_school_departments'])){
	$campus_id = $_POST['campus'];
	$faculty_id = $_POST['faculty'];
	$department_name = $_POST['department_name'];
	
	if(validate_form($campus_id,$faculty_id,$department_name)){
		include 'db_auth.php';
		$department_id = generate_department_id();
		$query = "insert into departments values('$department_id','$department_name','$faculty_id','$campus_id')";
		if($result = mysqli_query($conn, $query)){
			increaseCommits("commits","departments");
			echo "Deparment added";
		}else{echo "Could not add the department \"".$department_name."\"";}
	}
}

function validate_form($campus_id,$faculty_id,$department_name){
	$form_filled=true;
	if(empty($campus_id)||$campus_id=="select_campus"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Campus name.</span><br />';
	}
	if(empty($faculty_id)||$faculty_id==="select_faculty"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Faculty name.</span><br />';
	}
	if(empty($department_name)){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Department name.</span><br />';
	}
	
	return $form_filled;
}

function generate_department_id(){
	include 'db_auth.php';
	$department_id = "DEPARTMENT_".rand(0, 999);
	$existing_ids = mysqli_num_rows(mysqli_query($conn, "select `departments`.`department_id` from `departments` where `departments`.`department_id`='$department_id'"));
	switch($existing_ids){
		case 0: return $department_id;
			break;
		default: generate_faculty_id();
	}
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
