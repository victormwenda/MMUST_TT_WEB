<?php
require 'db_auth.php';
if (isset ( $_POST ['read_downloads'] )) {
	
	if ($_POST ['client'] == 'android_mobile') {
		$pursuing_course = $_POST ['pursuing_course'];
		$department_id = $_POST ['department_id'];
		$faculty_id = $_POST ['faculty_id'];
		$campus_id = $_POST ['campus_id'];
		$adm_yr = $_POST ['adm_yr'];
	}
	if ($_POST ['client'] == 'desktop' && session_start ()) {
		$pursuing_course = $_SESSION ['pursuing_course'];
		$department_id = $_SESSION ['department_id'];
		$faculty_id = $_SESSION ['faculty_id'];
		$campus_id = $_SESSION ['campus_id'];
		$adm_yr = $_SESSION ['adm_yr'];
	}
	
	$query = "SELECT *  FROM courses, uploads, downloads where
		
		`downloads`.`department_id` = '$department_id' AND
		`downloads`.`faculty_id`= '$faculty_id' AND
		`downloads`.`campus_id`= '$campus_id' AND
		`downloads`.`student_adm_yr`= '$adm_yr' AND
		`downloads`.`school_course`= '$pursuing_course'
		
		";
	
	if ($result = mysqli_query ( $conn, $query )) {
		
		while ( $downloads = mysqli_fetch_assoc ( $result ) ) {
			
			$filename = $downloads ['filename'];
			$filesize = $downloads ['filesize'];
			$filedesc = $downloads ['filedesc'];
			$fileuploader = $downloads ['fileuploader'];
			$file_upload_time = $downloads ['file_upload_time'];
			$fileuri = $downloads ['fileuri'];
			$course_name = $downloads ['course_name'];
		
			if ($_POST ['client'] == 'desktop') {
				showDownloads ($filename,$filesize,$filedesc,$fileuploader,$file_upload_time,$fileuri,$course_name);
		} else {
			
			echo json_encode ( array_map ( "utf8_encode", $downloads ) ) . ",";
			}
		}
	}
	
}else{echo "NOT SET";}


function showDownloads($filename,$filesize,$filedesc,$fileuploader,$file_upload_time,$fileuri,$course_name) {
	
echo '<div style="box-shadow:rgb(200,200,200) 3px 4px; border-radius:10px; width: 500px; margin:10px;  padding:5px; background-color:#eee; z-index:10;>
				<p style="font-family: verdana; padding:10px;">
					<label style=" float:left;font-size:14px;color:#AABBCC">' . $fileuploader . '</label>
					<label style=" float:right;font-size:14px;color:#AABBCC">' . getHumanTime($file_upload_time ). '</label>
					<br /><label style="font-size:18px;font-family: Arial;color:#0AB3F1">' . $filename . '</label> 
					<a style="float:right;" target="_blank" href="'.$fileuri.'"><img src="images/ui/ic_download_option.png"/></a>
					<br /><label style="font-size:12px;color:#999">' . $filedesc . '</label><br />
					<label style="font-size:14px; float:right;color:#AABBCC">' . $course_name . '</label>
					<label style="font-size:14px; float:left;color:#AABBCC">' . getFileSize($filesize) . '</label>
					
				</p>
	</div>';
	
}

function getHumanTime($file_upload_time ){
	return date("D M Y  H:i:s",$file_upload_time);
}
function getFileSize($filesize){
	
	if($filesize>1048576)
		return ($filesize/1048576) ." MB";
	if($filesize==1048576)
		return ( 1) ." MB";
	
	if($filesize>1024)
		return ( $filesize/1024) ." Kb";
	
	if($filesize==1024)
		return ( 1) ." Kb";
	
	if($filesize<1024)
		return ($filesize) ." Bytes";
	
	return "Unknown";
}
?>
