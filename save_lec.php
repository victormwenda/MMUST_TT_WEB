<?php
if(isset($_POST['save_lec_info'])){
	$lec_id="LEC_".rand(0,999);
	$lec_name =$_POST['lec_name'];
	$lec_phone =$_POST['lec_phone'];
	$lec_email =$_POST['lec_email'];
	$lec_qualification =$_POST['lec_qualification'];
	
	$lec_avator_name =$_FILES['lec_avator']['name'];
	$lec_avator_uri =$_FILES['lec_avator']['tmp_name'];
	$lec_avator_upload_uri = "uploads/images/avators/lec/".$lec_avator_name;
	if(validate_form($lec_name,$lec_phone,$lec_email,$lec_qualification,$lec_avator_name)){
		if(move_uploaded_file($lec_avator_uri, $lec_avator_upload_uri)){
			include 'db_auth.php';
			$link = $conn;
			
			
			$query = "INSERT INTO lecturer values ('$lec_id','$lec_name','$lec_email','$lec_phone','$lec_avator_upload_uri','$lec_qualification')";
			if(mysqli_query($link, $query)){
				increaseCommits("commits","lecturer");
				echo "Lecturer added successfully<br />";
			}else{ /*Delete file from server*/
				echo "Your upload was successful but a technical error has caused has caused a revert!<br />".mysqli_error($link);
			}
		}else{echo "Error:Upload failed<br />";}
	}
	
	
}

function validate_form($lec_name,$lec_phone,$lec_email,$lec_qualification,$lec_avator_name){
	$form_valid=true;
	if(empty($lec_name)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing lecturer name</span><br />';}
	if(empty($lec_phone)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing lecturer phonenumber</span><br />';}
	if(empty($lec_email)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing lecturer email</span><br />';}
	if(empty($lec_qualification)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing lecturer qualification</span><br />';}
	if(empty($lec_avator_name)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing lecturer avator</span><br />';}

	return $form_valid;
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