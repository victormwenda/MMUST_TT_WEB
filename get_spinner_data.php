<?php include 'db_auth.php';
	if(isset($_POST['campus'])&&!empty($_POST['campus'])){
	$campus = $_POST['campus'];
	
	$spinner = $_POST['spinner'];
	
	
	if($spinner=="faculty"){$query="select faculty_name,faculty_id from faculty where campus_id='$campus'";}
	
	if(isset($_POST['faculty'])&&!empty($_POST['faculty'])){
		$faculty=$_POST['faculty'];
		$query="select department_name,department_id from departments where faculty_id='$faculty' and campus_id='$campus'";
	}
	
	if(isset($_POST['department'])&&!empty($_POST['department'])){
		$department=$_POST['department'];
		$query="select course_name,course_code from school_courses where department_id='$department' and faculty_id='$faculty' and campus_id='$campus'";
		
	}
	
	if(isset($_POST['course'])&&!empty($_POST['course'])){
		$department=$_POST['department'];
		$yr = $_POST['student_adm_yr'];
		$course = $_POST['course'];
		$query="select course_name,course_code from courses where student_adm_yr = '$yr' and school_course_code = '$course' and department_id='$department' and faculty_id='$faculty' and campus_id='$campus'";
	
	}
	
	if($spinner=="faculty"){
		if ($result = mysqli_query ( $conn, $query )) {
			echo '<option value="select_faculty">Select faculty</option>';
			while ( $faculty = mysqli_fetch_assoc ( $result ) ) {
				echo '<option value="' . $faculty ['faculty_id'] . '">' . $faculty ['faculty_name'] . '</option>';
			}
		}
	}
	if($spinner=="department"){
		if ($result = mysqli_query ( $conn, $query )) {
			echo '<option value="select_department">Select department</option>';
			while ( $department = mysqli_fetch_assoc ( $result ) ) {
				echo '<option value="' . $department ['department_id'] . '">' . $department ['department_name'] . '</option>';
			}
		}
	}
	
	if($spinner=="courses"){
		
		 if ($result = mysqli_query ( $conn, $query )) {
			
			echo '<option value="select_course">Select course</option>';
			while ( $courses = mysqli_fetch_assoc ( $result ) ) {
				echo '<option value="' . $courses ['course_code'] . '">' . $courses ['course_name'] . '</option>';
			}
		} 
	}
	
	if($spinner=="student_adm_yr_courses"){
		if ($result = mysqli_query ( $conn, $query )) {
			
			echo '<option value="select_student_course">Select course</option>';
			while ( $courses = mysqli_fetch_assoc ( $result ) ) {
				echo '<option value="' . $courses ['course_code'] . '">' . $courses ['course_name'] . '</option>';
			}
		}
	}
	
}  //Will be called onload because campus is not set
	
if(!isset($_POST['campus'])){ 
	$spinner = $_POST['spinner'];
	
	if($spinner=="campus"){ //Called only onload
		$query="select * from campus";
		if ($result = mysqli_query ( $conn, $query )) {
			echo '<option value="select_campus">Select campus</option>';
			while ( $campuses = mysqli_fetch_assoc ( $result ) ) {
				echo '<option value="' . $campuses ['campus_id'] . '">' . $campuses ['campus_name'] . '</option>';
			}
		}
	}
}
?>
		