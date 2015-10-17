<?php 
if(isset($_POST['add_varsity_campuses'])){
	
	$campus_name = $_POST['campus_name'];
	
	if(validate_form($campus_name)){
		include 'db_auth.php';
		$campus_id = generate_campus_id();
		$query = "insert into campus values('$campus_id','$campus_name')";
		if($result = mysqli_query($conn, $query)){
			
			increaseCommits("commits","campus");
			echo "campus added";
		}else{echo "Could not add the campus \"".$campus_name."\"";}
	}
}

function validate_form($campus_name){
	$form_filled=true;
	if(empty($campus_name)){
		$form_filled = false;
		echo '<span style="color:#FF0000;font-family:monospace;" >Missing campus name.</span><br />';
	}
	
	return $form_filled;
}

function generate_campus_id(){
	include 'db_auth.php';
	$campus_id = "campus_".rand(0, 999);
	$existing_ids = mysqli_num_rows(mysqli_query($conn, "select `campus`.`campus_id` from `campus` where `campus`.`campus_id`='$campus_id'"));
	switch($existing_ids){
		case 0: return $campus_id;
			break;
		default: generate_campus_id();
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
