<?php
if (isset ( $_POST ['upload_file'] )) {
	$fileid= "FILE_".rand(0,999); 
	$filename = $_POST ['filename'];
	$filedesc = $_POST ['filedesc'];
	$fileuploader = $_POST ['file_uploader'];
	$user_doc = $_FILES ['user_doc'] ['name'];
	$fileuri = "uploads/docs/".$user_doc;
	
	$filesize =$_FILES ['user_doc'] ['size'];
	$temp_loc = $_FILES ['user_doc'] ['tmp_name'];
	$upload_time = time();
	
	if(validate_form($filename,$filedesc,$fileuploader,$user_doc)){
		if(move_uploaded_file($temp_loc,$fileuri )){
			include 'db_auth.php';
			$link = $conn;
			$query = "INSERT INTO uploads values ('$fileid','$filename','$filesize','$filedesc','$fileuploader','$upload_time','$fileuri')";
			if(mysqli_query($link, $query)){
				increaseCommits("commits","uploads");
				echo "Uploaded successfully<br />";
			}else{ /*Delete file from server*/
				echo "Your upload was successful but a technical error has caused has caused a revert!<br />";
			}
		}else{echo "Error:Upload failed<br />";}
	}
}

function validate_form($filename,$filedesc,$fileuploader,$user_doc){
	$form_valid = true;
	if(empty($filename)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing filename</span><br />';}
	if(empty($filedesc)){$form_valid = false;  echo '<span style="color:#FF0000;font-family:monospace;" >Missing file description</span><br />';}
	if(empty($fileuploader)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing uploader name</span><br />';}
	if(empty($user_doc)){$form_valid = false; echo '<span style="color:#FF0000;font-family:monospace;" >Missing file</span><br />';}
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