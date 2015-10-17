<?php session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>MMUST STUDENT TIMETABLE</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
		<script type="text/javascript" src="scripts/data.js"></script>
	</head>
	
	<body>
		<div id="template_container">
			<div id="template_head">
				<p>MMUST STUDENT TIMETABLE</p>
				<div id="student_details" style="text-align:right; font-size:14px;">
					<?php include 'db_auth.php';
						if(isset($_SESSION['reg_no'])){
							$reg_no = $_SESSION['reg_no'];
							$query = "select full_name from students where reg_no='$reg_no'";
							if($result = mysqli_query($conn, $query)){
								if($fullname = mysqli_fetch_assoc($result)){
									$name = $fullname['full_name'];
									echo "<label>".$reg_no." - ".$name."</label>";
								}
							}
							}
					?>
					<button id="log_out" onclick="requestLogOut()">Log out</button>
				</div>
				
			</div>
			
			<hr />
			
			<div id="parent_log_in" style="display:none;">
				<table>
				<tr>
						<td><p id="login_response"></p></td>
					</tr>
					<tr>
						<td><input id="input_reg_no" type="text" value="sit/0050/12"/></td>
					</tr>
							
					<tr>
						<td><input id="input_email" type="text" value="vmwenda.vm@gmail.com"/></td>
					</tr>
							
					<tr>
						<td><button id="btn_auth" onclick="auth()">Authenticate</button></td>
					</tr>
							
				</table>
			</div>
					
			<div id="navigation">
				<button id="btn_classes" onclick="readData('read_classes.php')">Classes</button>
				<button id="btn_assessments" onclick="readData('read_assessments.php')">Assessments</button>
				<button id="btn_courses" onclick="readData('read_courses.php')">Courses</button>
				<button id="btn_lecturers" onclick="readData('read_lecturer.php')">Lecturers</button>
				<button id="btn_downloads" onclick="readData('read_downloads.php')">Downloads</button>
				<hr />
				<div id="page_data">
			
					<div id="weekdays">
						<select  id="selected_day" onchange="readData('read_classes.php')";>
							<option value="0">Select weekday</option>
							<option value="1">Monday</option>
							<option value="2">Tuesday</option>
							<option value="3">Wednesday</option>
							<option value="4">Thursday</option>
							<option value="5">Friday</option>
						</select>
					</div>
					
					<div id="assessments">
						<select  id="assessment" onchange="readData('read_assessments.php')";>
							<option value="0">Assignments</option>
							<option value="1">C.A.T</option>
							<option value="2">End of Semester</option>
						</select>
					</div>
				</div>
				<div>
					<div id="requested_data" ></div>
					
				</div>
			</div>
			
			<div id="notifications">
				<p id="p_notifications"> Notifications </p><hr />
				<div id="wrapper_notifications"> 
					
				</div>
				
			</div>
		</div>
	</body>
</html>