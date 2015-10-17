<?php
	if(isset($_POST['advancedschoolinfo'])){
		
		$reg_no =$_POST['reg_no'];
		
		require 'db_auth.php';
		
		$query = "SELECT `students`.`reg_no`,`students`.`department_id`,`students`.`faculty_id`,`students`.`pursuing_course`, ";
				
				
		$query .= " `school_courses`.`course_code`,`school_courses`.`course_name`, ";
		$query .= " `departments`.`department_id`,`departments`.`department_name` , ";
		$query .= " `faculty`.`faculty_id`,`faculty`.`faculty_name` , ";
		$query .= " `campus`.`campus_id`,`campus`.`campus_name` ";
				
		$query .= " FROM `students`,`departments`,`faculty`,`school_courses`,`campus` ";
		
		$query .=" WHERE `students`.`reg_no`='$reg_no' ";
		$query .=" and `students`.`pursuing_course` = `school_courses`.`course_code` ";
		$query .=" and `students`.`department_id` = `departments`.`department_id` ";
		$query .=" and `students`.`faculty_id` = `faculty`.`faculty_id` ";
		$query .=" and `students`.`campus_id` = `campus`.`campus_id` ";
		
		if($result = mysqli_query($conn, $query)){
			while($advancedschoolinfo = mysqli_fetch_assoc($result)){
				echo json_encode(array_map("utf8_encode", $advancedschoolinfo));
			}
		}
	}
?>