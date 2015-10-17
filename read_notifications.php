<?php
require 'db_auth.php';
$query = "SELECT * FROM notifications WHERE ";
session_start();

	
	if ($_POST ['client'] == 'android_mobile') {
		$pursuing_course = $_POST ['pursuing_course'];
		$department_id = $_POST ['department_id'];
		$faculty_id = $_POST ['faculty_id'];
		$campus_id = $_POST ['campus_id'];
		$adm_yr = $_POST ['adm_yr'];
		
		$query .= "`notifications`.`school_course` =  'ALL_CRS' OR `notifications`.`school_course` =  '$pursuing_course'
						AND `notifications`.`department_id` = 'ALL_DEP' OR `notifications`.`department_id` = '$department_id' 
						AND `notifications`.`faculty_id` = 'ALL_FAC' OR `notifications`.`faculty_id` = '$faculty_id' 
						AND `notifications`.`campus_id` = 'ALL_CAM'  OR `notifications`.`campus_id` = '$campus_id'
						AND `notifications`.`student_adm_yr`= '0000' OR `notifications`.`student_adm_yr`= '$adm_yr'";
	}
	if($_POST ['client'] == 'desktop'){	
		$reg_no = $_SESSION ['reg_no'];
		$pursuing_course = $_SESSION ['pursuing_course'];
		$department_id = $_SESSION ['department_id'];
		$faculty_id = $_SESSION ['faculty_id'];
		$campus_id = $_SESSION ['campus_id'];
		$adm_yr = $_SESSION ['adm_yr'];
	
		$query .= "`notifications`.`school_course` =  'ALL_CRS' OR `notifications`.`school_course` =  '$pursuing_course'
						AND `notifications`.`department_id` = 'ALL_DEP' OR `notifications`.`department_id` = '$department_id' 
						AND `notifications`.`faculty_id` = 'ALL_FAC' OR `notifications`.`faculty_id` = '$faculty_id' 
						AND `notifications`.`campus_id` = 'ALL_CAM'  OR `notifications`.`campus_id` = '$campus_id'
						AND `notifications`.`student_adm_yr`= '0000' OR `notifications`.`student_adm_yr`= '$adm_yr'";

	}
if($result = mysqli_query($conn, $query)){
		
	while($notifications = mysqli_fetch_assoc($result)){
		$n_id= $notifications['notification_id'];
		$n_title= $notifications['notification_title'];
		$n_desc= $notifications['notification_message'];
		$n_sender= $notifications['notification_sender'];
		$n_send_time= $notifications['notification_send_time'];
		
		if ($_POST ['client'] == 'desktop') {
			showNotification($n_id,$n_title,$n_desc,$n_sender,$n_send_time);
		} else {
			echo json_encode(array_map("utf8_encode", $notifications)).",";
		}
		
	}
}else{
	echo "Error ".mysqli_error($conn)." <br />";
}

function showNotification($n_id,$n_title,$n_desc,$n_sender,$n_send_time){
	echo '<div style=" box-shadow:rgb(200,200,200) 3px 4px; border-radius:10px; width: 350px; margin:5px; background-color:#eee; z-index:10;">
	<p style="font-family: verdana; padding:5px;">
	<label style="font-size:12px; float:right; color:#aaa;">'.date("D M Y H:i",$n_send_time).'</label>
	<label style="font-size:12px; float:left; color:#afafaf;">'.$n_sender.'</label><br />
	<label style="font-size:16px; float:left; color:#378de5;">'.$n_title.'</label><br />
	<label style="font-size:13px; color:#aabbcc;"> '.$n_desc.'</label><br />
	</p>
	</div>';
	
}
?>