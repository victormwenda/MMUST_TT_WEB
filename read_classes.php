<?php
$client = $_POST['client'];

$count_1 = 1;$count_2 = 1;$count_3 = 1;$count_4 = 1;$count_5 = 1;
require 'db_auth.php';
$query = "SELECT `courses`.`course_name`,`courses`.`course_code`,`lecturer`.`lec_name`,`lecturer`.`lec_id`,`classes`.`class_room`,`classes`.`class_start`,`classes`.`class_stop`,`classes`.`class_days` FROM classes, lecturer,courses where`lecturer`.`lec_id`=`classes`.`lec_id` and `classes`.`course_code` = `courses`.`course_code` ";

if(isset($_POST['selected_day'])){
	$day = $_POST['selected_day'];
	if($day!="0")
	$query = "SELECT `courses`.`course_name`,`courses`.`course_code`,`lecturer`.`lec_name`,`lecturer`.`lec_id`,`classes`.`class_room`,`classes`.`class_start`,`classes`.`class_stop`,`classes`.`class_days` FROM classes, lecturer,courses where`lecturer`.`lec_id`=`classes`.`lec_id` and `classes`.`course_code` = `courses`.`course_code` and `classes`.`class_days` = '$day' ";
}

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
	
	$query .= " AND `classes`.`school_course_id` = '$pursuing_course' AND `classes`.`department_id` = '$department_id'
	AND `classes`.`faculty_id` = '$faculty_id' AND `classes`.`campus_id` = '$campus_id' AND   `classes`.`student_adm_yr`= '$adm_yr'";
	
}
$query .= " ORDER BY  `classes`.`class_days` ASC ";

if($result = mysqli_query($conn, $query)){

	while($classes = mysqli_fetch_assoc($result)){
		$course_name= $classes['course_name'];
		
		$lec_name= $classes['lec_name'];
		$class_room = $classes['class_room'];
		$class_start =$classes['class_start'];
		$class_stop = $classes['class_stop'];
		$class_days = $classes['class_days'];

		if($client=="desktop")
			showClasses($course_name,$lec_name,$class_room,$class_start,$class_stop,$class_days);
		else{
			
			echo json_encode(array_map("utf8_encode", $classes)).",";
		}
	}
}else{
	echo "Error ".mysqli_error($conn)."<br />";
}

function showClasses($course_name,$lec_name,$class_room,$class_start,$class_stop,$class_days){
	global $count_1; global $count_2 ;global $count_3 ;global $count_4 ;global $count_5 ;
	global $day;
	if($class_days==1){
		
		if($count_1==1){
			if($day=="0")
			echo '<p style="font-family:Arial;font-size: 18px;">' . getDay($class_days) . '</p><hr />';
		}
		$count_1++;
	}
	if($class_days==2){
		
		if($count_2==1){
			if($day=="0")
			echo '<p style="font-family:Arial;font-size: 18px;">' . getDay($class_days) . '</p><hr />';
		}
		$count_2++;
	}
	if($class_days==3){
		if($count_3==1){
			if($day=="0")
			echo '<p style="font-family:Arial;font-size: 18px;">' . getDay($class_days) . '</p><hr />';
		}
		$count_3++;
	}
	if($class_days==4){
		
		if($count_4==1){
			if($day=="0")
			echo '<p style="font-family:Arial;font-size: 18px;">' . getDay($class_days) . '</p><hr />';
		}
		$count_4++;
	}
	if($class_days==5){
		
		if($count_5==1){
			if($day=="0")
			echo '<p style="font-family:Arial;font-size: 18px;">' . getDay($class_days) . '</p><hr />';
		}
		$count_5++;
	}
	
	echo '<div
	style="height: 80px; box-shadow: rgb(200, 200, 200) 3px 4px; border-radius: 10px; width: 500px; margin: 5px; background-color: #eee; z-index: 10;">
	<p style="font-family: verdana; padding: 10px;">
	<label style="font-size: 16px; float: right;">' . $class_start . ' - '. $class_stop . '</label><br />
	<label style="font-size: 22px;">' . $course_name . '</label><br /> <label
	style="font-size: 16px; float: left;">' . $lec_name . '</label> <label
	style="font-size: 16px; float: right;">' . $class_room . '</label>
	</p>
	</div>';
}

function getDay($class_days){
	if($class_days==1)return "Monday";
	if($class_days==2)return "Tuesday";
	if($class_days==3)return "Wednesday";
	if($class_days==4)return "Thursday";
	if($class_days==5)return "Friday";
}

?>




