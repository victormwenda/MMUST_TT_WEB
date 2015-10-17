<?php 
if(isset($_POST['add_school_faculties'])){
	
	$faculty_name = $_POST['faculty_name'];
	$campus_id = $_POST['campus'];
	
	if(validate_form($faculty_name,$campus_id)){
		include 'db_auth.php';
		$faculty_id = generate_faculty_id();
		$query = "insert into faculty values('$faculty_id','$faculty_name','$campus_id')";
		if($result = mysqli_query($conn, $query)){
			increaseCommits("commits","faculty");
			echo "Faculty added";
		}else{echo "Could not add the faculty \"".$faculty_name."\"";}
	}
}

function validate_form($faculty_name,$campus_id){
	$form_filled=true;
	if(empty($faculty_name)){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Faculty name.</span><br />';
	}
	if(empty($campus_id)||$campus_id=="select_campus"){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing Campus name.</span><br />';
	}
	return $form_filled;
}

function generate_faculty_id(){
	include 'db_auth.php';
	$faculty_id = "FACULTY_".rand(0, 999);
	$existing_ids = mysqli_num_rows(mysqli_query($conn, "select `faculty`.`faculty_id` from `faculty` where `faculty`.`faculty_id`='$faculty_id'"));
	switch($existing_ids){
		case 0: return $faculty_id;
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
