<?php
require 'db_auth.php';
$query = "SELECT  * FROM lecturer,courses where `lecturer`.`lec_id` =`courses`.`lec_id`";

if ($_POST ['client'] == 'android_mobile') {
		$pursuing_course = $_POST ['pursuing_course'];
		$department_id = $_POST ['department_id'];
		$faculty_id = $_POST ['faculty_id'];
		$campus_id = $_POST ['campus_id'];
		$adm_yr = $_POST ['adm_yr'];
	}

if($_POST ['client'] == 'desktop'&&session_start()){
	$pursuing_course = $_SESSION ['pursuing_course'];
	$department_id = $_SESSION ['department_id'];
	$faculty_id = $_SESSION ['faculty_id'];
	$campus_id = $_SESSION ['campus_id'];
	$adm_yr = $_SESSION ['adm_yr'];

	$query .= " AND `courses`.`school_course_code` = '$pursuing_course' AND `courses`.`department_id` = '$department_id'
	AND `courses`.`faculty_id` = '$faculty_id' AND `courses`.`campus_id` = '$campus_id' AND   `courses`.`student_adm_yr`= '$adm_yr'";
	
}

if($result = mysqli_query($conn, $query)){
		
	while($lec_info = mysqli_fetch_assoc($result)){

		$lec_name= $lec_info['lec_name'];
		$lec_email=$lec_info['lec_email'];
		$lec_phone=$lec_info['lec_phone'];
		$lec_avator	=$lec_info['lec_avator_uri'];
		$lec_qualification =$lec_info['lec_qualification'];
		$course_name=$lec_info['course_name'];	
		
		if ($_POST ['client'] == 'desktop') {
			showLec($lec_name,$lec_email,$course_name,$lec_phone,$lec_avator,$lec_qualification);
		} else {
			echo json_encode(array_map("utf8_encode", $lec_info)).",";
		}
		
	}
}


function showLec($lec_name,$lec_email,$course_name,$lec_phone,$lec_avator,$lec_qualification) {
	echo '<table>
			<tr>
				<td >
					<div>
						<img alt="lec_avator" src="'.$lec_avator.'" style="width:120px; height:150px; border:1px solid #ccc;border-radius:5px; padding:3px;">
					</div>
				</td><td>
					<div style="margin:0px 10px 10px 10px; ">
			
						<label>Name : '.$lec_name.'</label><br />
							
						<label>Email : <a href="mailto:'.$lec_email.'">'.$lec_email.'</a></label><br />
					
						<label>Phonenumber : <a href="tel:'.$lec_phone.'">'.$lec_phone.'</a></label><br /><br />
					
						<label><span><u><em>Qualifications<em></u></span><br /> '.$lec_qualification.'</label>
					</div>
				</td>
			</tr>
		<table>
		<hr />';
}
?>
