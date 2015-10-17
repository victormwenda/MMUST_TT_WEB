<?php session_start();
?>
<!DOCTYPE html>
<html>
	
	
	<body>
		<div id="template_container">
			<div id="template_head">
				<p>MMUST STUDENT TIMETABLE - Admin Panel</p>
				<div id="student_details" style="text-align:right; font-size:14px;">
					<?php include 'db_auth.php';
						if(isset($_SESSION['mmust_admin_username'])){
							$username = $_SESSION['mmust_admin_username'];
							$query = "select username from admin where username='$username'";
							if($result = mysqli_query($conn, $query)){
								if($admin_username = mysqli_fetch_assoc($result)){
									$name = $admin_username['username'];
									echo "<label>Welcome ".$name.",</label>";
								}
							}
							}
					?>
					<button id="log_out" onclick="requestLogOut()">Log out</button>
				</div>
				
			</div>
			
		
			
			<div id="parent_log_in" style="display:none;">
				<table>
					<tr>
						<td><p id="login_response"></p></td>
					</tr>
					<tr>
						<td><input id="input_admin_username" type="text" value="victor_mwenda"/></td>
					</tr>
							
					<tr>
						<td><input id="input_admin_password" type="password" value="victor_mwenda"/></td>
					</tr>
							
					<tr>
						<td><button id="btn_auth" onclick="auth()">Authenticate</button></td>
					</tr>
							
				</table>
			</div>
				
			<div id="admin_navigation">
				<hr />	
				<button id="btn_classes" onclick="saveClasses()">Classes</button>
				<select id="spinner_assessment" onchange="saveAssessments()">
					<option value="select_assessments">Assessments</option>
					<optgroup label="Take away Exams">
						<option value="assessment_assignment">Assignments</option>
					</optgroup>
					<optgroup label="Sitting Exams">
						<option value="assessment_cat">C.A.T</option>
						<option value="assessments_end_of_sem">End of Semester</option>
					</optgroup>

				</select>
				<select id="spinner_courses" onchange="saveCourses()">
					<option value="select_courses">School & Courses</option>
					
					<optgroup label="Students">
						<option value="student_courses">Semester courses</option>
					</optgroup>
					<optgroup label="School">
						<option value="school_courses">Courses offered</option>
					</optgroup>
					<optgroup label="Departments">
						<option value="school_departments">Faculty Departments</option>
					</optgroup>
					<optgroup label="Faculties/Schools">
						<option value="school_faculties">Varsity Faculties</option>
					</optgroup>
					<optgroup label="Campuses">
						<option value="varsity_campuses">Varsity campuses</option>
					</optgroup>
				</select>
				
				<select id="spinner_scholars"  onchange="saveScholars()">
					<option value="select_scholars" >Scholars</option>
					<optgroup label="Students">
						<option value="save_students" >Register Students</option>
					</optgroup>	
					
					<optgroup label="Lecturers">
						<option value="save_lecturers" >Register Lecturers</option>
					</optgroup>
				</select>
				
				<button id="btn_notifications" onclick="saveNotifications()">Notifications</button>
				
				<select id="spinner_files" onchange="saveFiles()">
					<option value="select_files_manipulation">Files</option>
					<optgroup label="Upload">
						<option value="upload_files">Upload files</option>
						
					</optgroup>
					<optgroup label="Uploaded files">
						<option value="save_downloads">Create Downloads</option>
					</optgroup>
				</select>
				<hr />
			</div>
				
			<div id="page_data">
						
				<div id="course_select_hierachy"> 
				
					<div id="div_student_adm_yr" style="float:left; border:2px solid #ccc; box-shadow:rgb(240,240,240) 5px 5px; border-radius:10px; padding:10px; margin:0px 20px 0px 20px;">
						<p style="width:190px; padding:5px; font-family:Arial;font-size:12px;color:#999;border:1px solid #aabbcc; border-radius:5px;">Please use only when needed.</p>
						
						<select id="spinner_student_adm_yr" onchange="onStudentAdmYrSelected()">
							<option value="student_adm_yr">Student adm year</option>
								<?php $yr =  date("Y",time());
									for($cur_yr = $yr;$cur_yr > ($yr - 10); $cur_yr--){
										echo '<option value="'.$cur_yr.'">'.$cur_yr.'</option>';
										}
								?>
						</select><br />
						
						<select id="spinner_student_adm_yr_courses" onchange="onStudentAdmYrCoursesSelected()">
							<option>Students units</option>
						</select>
						
					</div>
					<div style="float:left; border:2px solid #ccc; box-shadow:rgb(240,240,240) 5px 5px; border-radius:10px; padding:10px; margin:0px 20px 0px 0px;">
						<select id="campus_spinner" onchange="onCampusSelected();"></select>
						<select id="faculty_spinner" onchange="onFacultySelected()"></select>
						<select id="department_spinner" onchange="onDepartmentSelected()"></select>
						<select id="courses_spinner" onchange="onCourseSelected()"></select>
					</div>
				
					<div style="clear:both; margin:3px; " ><p id="commit_result"></p></div>		
				</div>
							
					<div id="container_page_data">
						
						<div id="div_input_fields_container"> 
							<div id="save_assignment">
									<table>
										<!-- <tr>
											<td>Assignment no.</td>
										</tr>
										 -->
										<tr>
											<td><input  required="required" type="text" name="assignment_no" id="assignment_no"  placeholder="Enter assignment no"/></td>
										</tr>
										
										<tr>
											<td>Submission_date</td>
										</tr>
										
										<tr>
											<td><input  required="required" type="date" name="submission_date" id="submission_date" /></td>
										</tr>
										
										<tr>
											<td><button  name="add_assignments"  id="add_assignments" value="Add assignments" onclick="saveData('save_assignment.php')" >Save Assignments</button></td>
										</tr>
									</table>
							</div>
							<div id="save_classes">
								<!-- <form action="save_classes.php" method="POST"> -->
									<table>
										<!-- <tr>
											<td>Course name</td>
										</tr> 
										<!-- Fetch courses list from Database 
										<tr>
											<td>
												<select name="selected_course" id="classes_selected_course">
												<option value="select_course">Select course</option>
												<?php /* include 'db_auth.php';
													$link = $conn;
													$query = "SELECT course_code,course_name FROM courses";
													if($result = mysqli_query($link, $query)){
														while($course_data = mysqli_fetch_assoc($result)){
															$course_code = $course_data['course_code'];
															$course_name = $course_data['course_name'];
															
															echo '<option value="'.$course_code.'">'.$course_name.'</option>';
														}
													} */
												?>
												</select>
											</td>
										</tr>-->
										
										<!-- <tr>
											<td>Lecturer name</td>
										</tr> -->
										<!-- Fetch courses list from Database -->
										<tr>
											<td>
												<select name="spinner_lec" id="spinner_lec">
													<option value="select_lec">Select lecturer</option>
												<?php include 'db_auth.php';
													$link = $conn;
													$query = "SELECT lec_id,lec_name FROM lecturer";
													if($result = mysqli_query($link, $query)){
														while($lec_data = mysqli_fetch_assoc($result)){
															$lec_id = $lec_data['lec_id'];
															$lec_name = $lec_data['lec_name'];
															
															echo '<option value="'.$lec_id.'">'.$lec_name.'</option>';
														}
													}
												?>
												</select>
											</td>
										</tr>
										<!-- <tr>
											<td>Class room</td>
										</tr> -->
										<tr>
											<td><input  required="required" type="text"  id="class_room" name="class_room"  placeholder="Enter lecture hall/room"/></td>
										</tr>
										
										<!-- <tr>
											<td>Class days</td>
										</tr> -->
										<table>
											<tr>
												<td colspan="2">School days</td> <td>Class start</td><td>Class end</td>
											</tr>
											<tr>
												<td><input style="display: none;" value="1" style="width:15px;height:15px;color:#00CC00;" id="monday" type="checkbox" /></td><td>Monday</td> <td><input id="monday_start" type="time"/></td><td><input id="monday_stop" type="time"/></td>
											</tr>
											<tr>
												<td><input style="display: none;" value="1" style="width:15px;height:15px;color:#00CC00;" id="tuesday" type="checkbox" /></td><td>Tuesday</td> <td><input id="tuesday_start" type="time"/></td><td><input id="tuesday_stop" type="time"/></td>
											</tr>
											<tr>
												 <td><input style="display: none;" value="1" style="width:15px;height:15px;color:#00CC00;" id="wednesday" type="checkbox" /></td><td>Wednesday</td><td><input id="wednesday_start" type="time"/></td><td><input id="wednesday_stop" type="time"/></td>
											</tr>
											<tr>
											 	<td><input style="display: none;" value="1" style="width:15px;height:15px;color:#00CC00;" id="thursday" type="checkbox" /></td>	<td>Thursday</td><td><input id="thursday_start" type="time"/></td><td><input id="thursday_stop" type="time"/></td>
											</tr>
											<tr>
												<td><input style="display: none;" value="1" style="width:15px;height:15px;color:#00CC00;" id="friday" type="checkbox" /></td><td>Friday</td> <td><input id="friday_start" type="time"/></td><td><input id="friday_stop" type="time"/></td>
											</tr>
										</table>
										<tr>
											<!-- <td colspan="3"><input  type="submit"  name="add_class" value="Add class(es)" style="margin:10px 0px 10px 0px;height:30px; color:#999999; background:#FFFFFF; padding:0px 5px 0px 5px;border:1px solid #777; border-radius:8px; box-shadow:rgb(200,200,200) 5px 5px;"/></td> -->
											<td><button id="add_class" name="add_class" onclick="saveData('save_classes.php')" >Add class(es)</button></td>
										</tr>
									</table>
								
								<!-- </form> -->
							</div>
							
							
							<div id="save_courses">
							<!-- <form action="save_courses.php" method="POST"> -->
										<table>
											<!-- <tr>
												<td>Course code</td>
											</tr> -->
											<tr>
												<td><input  required="required" type="text" name="course_code" id="course_code"  placeholder="Enter course code"/></td>
											</tr>
											
											<!-- <tr>
												<td>Course name</td>
											</tr> -->
											<tr>
												<td><input  required="required" type="text" name="course_name" id="course_name"  placeholder="Enter course name:"/></td>
											</tr>
											
											<!-- <tr>
												<td>Lecturer</td>
											</tr> -->
											
											<!-- Fetch Lec list from Database -->
											<tr>
												<td>
													<select name="course_lec" id="course_lec">
													<option value="select_lec">Select Lecturer</option>
													<?php include 'db_auth.php';
														$link = $conn;
														$query = "SELECT lec_id,lec_name FROM Lecturer";
														if($result = mysqli_query($link, $query)){
															while($lec_data = mysqli_fetch_assoc($result)){
																$lec_id = $lec_data['lec_id'];
																$lec_name = $lec_data['lec_name'];
																
																echo '<option value="'.$lec_id.'">'.$lec_name.'</option>';
															}
														}
													?>
													</select>
												</td>
											</tr>
											<!-- <tr>
												<td>
													<select id="spinner_student_adm_yr">
														<option value="student_adm_yr">Student adm year</option>
														<?php /* $yr =  date("Y",time());
																for($cur_yr = $yr;$cur_yr > ($yr - 10); $cur_yr--){
																echo '<option value="'.$cur_yr.'">'.$cur_yr.'</option>';
															} */
														?>
													</select>
												</td>
											</tr> -->
											<tr>
												<td><button id="add_course" name="add_course" onclick="saveData('save_courses.php')" >Add Course</button></td>
												<!--  <td><input type="submit" id="add_course" name="add_course" value="Add Course"/></td> -->
											</tr>
										</table>
									
									</form>
							</div>
							
							<div id="save_downloads">
									<!-- <form action="save_downloads.php" method="POST"> -->
										<table>
											
											
											<tr>
												<td>File name</td>
											</tr>
											<!-- Fetch files list from Database -->
											<tr>
												<td>
													<select name="selected_file" id="selected_file">
													<option value="select_file">Select file</option>
													<?php include 'db_auth.php';
														$link = $conn;
														$query = "SELECT filename,fileid FROM uploads";
														if($result = mysqli_query($link, $query)){
															while($course_data = mysqli_fetch_assoc($result)){
																$fileid = $course_data['fileid'];
																$filename = $course_data['filename'];
																
																echo '<option value="'.$fileid.'">'.$filename.'</option>';
															}
														}
													?>
													</select>
												</td>
											</tr>
											<tr>
												<td><input value="1" id="cb_d_campuses" type="checkbox" style="width:15px;height:15px;color:#00CC00;" >Notifiy all campuses</input></td>
											</tr>
											<tr>
												<td><input value="1" id="cb_d_faculties" type="checkbox" style="width:15px;height:15px;color:#00CC00;" >Notifiy all faculties</input></td>
											</tr>
											<tr>
												<td><input value="1" id="cb_d_departments" type="checkbox" style="width:15px;height:15px;color:#00CC00;" >Notifiy all departments</input></td>
											</tr>
											<tr>
												<td><input value="1" id="cb_d_courses" type="checkbox" style="width:15px;height:15px;color:#00CC00;">Notifiy all courses</input></td>
											</tr>
											<tr>
												<!-- <td><input type="submit" name="add_download" value="Add download"/></td> -->
												<td><button onclick="saveData('save_downloads.php');" name="add_download" id="add_download" >Add download</button></td>
											</tr>
										</table>
									
									<!-- </form> -->
														
							</div>
							
							<div id="save_exams">
		
									<table>
								
										<!-- <tr>
											<td>Exam type</td>
										</tr> -->
										<!-- Fetch courses list from Database -->
										<tr>
											<td><select name="exam_type"  id="exam_type">
													<option value="select_exam_type">Select exam type</option>
													<option value="1">C.A.T</option>
													<option value="2">End of Sem</option>
											</select></td>
										</tr>
								
										
										<!-- Fetch courses list from Database
										<tr>
											<td><select name="selected_course"  id="exams_selected_course">
													<option value="select_course">Select course</option>
													<?php /* include 'db_auth.php';
														$link = $conn;
														$query = "SELECT course_code,course_name FROM courses";
														if($result = mysqli_query($link, $query)){
															while($course_data = mysqli_fetch_assoc($result)){
																$course_code = $course_data['course_code'];
																$course_name = $course_data['course_name'];
																
																echo '<option value="'.$course_code.'">'.$course_name.'</option>';
															}
														} */
													?>
													</select></td>
										</tr> -->
								
										<tr>
											<td>Exam date</td>
										</tr>
								
										<tr>
											<td><input  required="required" type="date" name="exam_date" id="exam_date" /></td>
										</tr>
								
										<tr>
										
										
										<tr>
											<td>Exam start</td>
											<!-- Use a time picker for input -->
										</tr>
								
										<tr>
											<td><input  required="required" type="time" name="exam_start" id="exam_start"  /></td>
											<!-- Use a time picker for input -->
										</tr>
								
										<tr>
											<td>Exam duration(hrs)</td>
										</tr>
										<tr>
											<td><input  required="required" type="number" name="exam_duration" id="exam_duration" /></td>
										</tr>
										<tr>
											<td>Exam room</td>
										</tr>
										<tr>
											<td><input  required="required" type="text" name="exam_room" id="exam_room" 
												placeholder="Enter lecture hall/room" /></td>
										</tr>
								
										<tr>
											<td><button  name="add_exam" id="add_exam" onclick="saveData('save_exams.php')" >Add Exam</button></td>
										</tr>
								
								
									</table>
								
							
														
							</div>
							
							<div id="save_lec">
									<form action="save_lec.php" method="POST" enctype="multipart/form-data">
										<table>
											<tr>
												<td>Lecturer name</td>
											</tr>
											
											<tr>
												<td><input required="required"  type="text" name="lec_name"  placeholder="Enter lecturer name"/></td>
											</tr>
											
											<tr>
												<td>Lecturer phonenumber</td>
											</tr>
											
											<tr>
												<td><input required="required" type="tel" name="lec_phone"  placeholder="Enter lecturer phonenumber"/></td>
											</tr>
											
											<tr>
												<td>Lecturer email</td>
											</tr>
											
											<tr>
												<td><input required="required" type="text" name="lec_email"  placeholder="Enter lecturer email"/></td>
											</tr>
											
											<tr>
												<td>Lecturer qualification</td>
											</tr>
											
											<tr>
												<td><textarea  required="required" type="text" name="lec_qualification"  placeholder="Enter lecturer qualification"></textarea></td>
											</tr>
											
											<tr>
												<td>Lecturer avator</td>
											</tr>
											
											<tr>
												<td><input  required="required" type="file" name="lec_avator" /></td>
											</tr>
											
											<tr>
												<td><input type="submit" name="save_lec_info" value="Save Lec Info"/></td>
											</tr>
										</table>
									
									</form>
							</div>
							
							<div id="save_notifications">
								<!-- 	<form action="save_notifications.php" method="post"> -->
										<table>
											<!-- <tr>
												<td>Notification Title</td>
											</tr> -->
											
											<tr>
												<td><input required="required" type="text" name="n_title" id="n_title"   placeholder="Enter notitification title"/></td>
											</tr>
											
											<!-- <tr>
												<td>Notification message</td>
											</tr> -->
											
											<tr>
												<td><input required="required" type="text" name="n_message" id="n_message"  placeholder="Enter notitification message"/></td>
											</tr>
											
											<!-- <tr>
												<td>Notification sender</td>
											</tr> -->
											
											<tr>
												<td><input  id="cb_campuses" type="checkbox" style="width:15px;height:15px;color:#00CC00;" /><label>Notifiy all campuses</label></td>
											</tr>
											<tr>
												<td><input  id="cb_faculties" type="checkbox" style="width:15px;height:15px;color:#00CC00;" /><label>Notifiy all faculties</label></td>
											</tr>
											<tr>
												<td><input  id="cb_departments" type="checkbox" style="width:15px;height:15px;color:#00CC00;" /><label>Notifiy all departments</label></td>
											</tr>
											<tr>
												<td><input  id="cb_courses" type="checkbox" style="width:15px;height:15px;color:#00CC00;"/><label>Notifiy all courses</label></td>
											</tr>
											
											<tr>
												<td><input required="required" type="text" name="n_sender" id="n_sender"  placeholder="Enter notitification sender name"/></td>
											</tr>
											
											<tr>
												<!-- <td><input type="submit" name="add_notification" value="Add Notification" /></td> -->
												<td><button id="add_notification" onclick="saveData('save_notifications.php')" name="add_notification" >Post Notification</button></td>
											</tr>
										</table>
									
									<!-- </form> -->
							</div>
							
							<div id="save_student">
									<!-- <form action="add_student.php" method="POST"> -->
										<table>
											<!-- <tr>
												<td>Registration number</td>
											</tr> -->
											<tr>
												<td><input id="student_reg_no" required="required" type="text" name="reg_no"  placeholder="Enter registration number"/></td>
											</tr>
											
											<!-- <tr>
												<td>Student full name</td>
											</tr> -->
											<tr>
												<td><input id="student_full_name" required="required" type="text" name="full_name"  placeholder="Enter student full name:"/></td>
											</tr>
											
											<!-- <tr>
												<td>Pursuing course</td>
											</tr> -->
											
											<!-- 
											<tr>
												<td>
													<select name="pursuing_course" id="student_pursuing_course">
													<option value="select_course">Select course</option>
													<?php /* include 'db_auth.php';
														$link = $conn;
														$query = "SELECT * FROM school_courses";
														if($result = mysqli_query($link, $query)){
															while($course_data = mysqli_fetch_assoc($result)){
																$course_code = $course_data['course_code'];
																$course_name = $course_data['course_name'];
																
																echo '<option value="'.$course_code.'">'.$course_name.'</option>';
															}
														} */
													?>
													</select>
												</td>
											</tr> -->
											
											<!-- <tr>
												<td>Phonenumber</td>
											</tr> -->
											<tr>
												<td><input id="student_phonenumber" required="required" type="tel" name="phonenumber"  placeholder="Enter phonenumber"/></td>
											</tr>
											
											<!-- <tr>
												<td>Email address</td>
											</tr> -->
											<tr>
												<td><input id="student_email" required="required" type="text" name="email"  placeholder="Enter email address"/></td>
											</tr>
											
											<tr>
												<td>
													<select id="student_student_category" name="student_category">
														<option value="select_cat">Select student category</option>
														<option value="2">General Student</option>
														<option value="1">Class representative</option>
													</select>
												</td>
											</tr>
											<tr> 
												<td><button id="add_student" name="add_student" onclick="saveData('add_student.php')">Add Student</button></td>
												<!-- <td><input type="submit" name="add_student" value="Add Student" /></td> -->
											</tr>
										</table>
									
									<!-- </form> -->
							</div>
							<div id="save_school_courses">
									<!-- <form action="add_school_courses.php" method="POST"> -->
										<table>
											<!-- <tr>
												<td>Course code</td>
											</tr> -->
											<tr>
												<td><input  required="required" type="text" id="school_courses_course_code" name="course_code"  placeholder="Enter course code"/></td>
											</tr>
											
											<!-- <tr>
												<td>Course name</td>
											</tr> -->
											<tr>
												<td><input  required="required" type="text" id="school_courses_course_name" name="course_name"  placeholder="Enter course name:"/></td>
											</tr>
											
											
											<tr>
												<!-- <td><input type="submit" name="add_school_courses" value="Add Course" /></td> -->
												<td><button onclick="saveData('add_school_courses.php')" name="add_school_courses">Add School Courses</button></td>
												
											</tr>
										</table>
									
									<!-- </form> -->
							</div>
							<div id="save_school_faculties">
								<!-- <form action="add_school_faculties.php" method="POST"> -->
									<table>
									
										<!-- <tr>
											<td>Faculty name</td>
										</tr> -->
										<tr>
											<td><input  required="required" type="text" id="school_faculties_name" name="faculty_name"  placeholder="Enter faculty name:"/></td>
										</tr>
									
									
										<tr>
											<!-- <td><input onsubmit="saveData('add_school_faculties.php')" type="submit" name="add_school_faculties" value="Add Faculty" /></td>  -->
											<td><button onclick="saveData('add_school_faculties.php')"  id="add_school_faculties" name="add_school_faculties">Add Faculty</button></td>
										</tr>
									</table>
							
								<!-- </form> -->
							</div>
					
						
						<div id="save_faculty_departments">
							<!-- <form action="add_school_departments.php" method="POST"> -->
									<table>
									
										<!-- <tr>
											<td>Faculty name</td>
										</tr> 
										<tr>
											<td>
												<select id="school_departments_faculty_name" name="faculty_name">
													<option value="select_faculty">Select faculty</option>
													<?php 
														/* include 'db_auth.php';
														$query = "select * from faculty";
														if($result = mysqli_query($conn, $query)){
															while($faculties = mysqli_fetch_assoc($result)){
																echo '<option value="'.$faculties['faculty_id'].'">'.$faculties['faculty_name'].'</option>';
															}
														} */
													?>
												</select>
											</td>
										</tr> -->
									
										<!-- <tr>
											<td>Department name</td>
										</tr> -->
										<tr>
											<td><input  required="required" type="text" id="school_department_name" name="department_name"  placeholder="Enter department name:"/></td>
										</tr>
										
										<tr>
											<!--  <td><input onsubmit="saveData('add_school_departments.php')" type="submit" name="add_school_departments" value="Add Department" /></td> -->
										<td><button onclick="saveData('add_school_departments.php')" id="add_school_departments" name="add_school_departments">Add Department</button></td>
										</tr>
									</table>
							
								<!-- </form> -->
						
							</div>
							<div id="save_varsity_campuses">
								<!-- <form action="add_varisty_campuses.php" method="POST"> -->
									<table>
									
										<tr>
											<td>Campus name</td>
										</tr>
										<tr>
											<td><input  required="required" type="text" id="varisty_campus_name" name="campus_name"  placeholder="Enter campus name:"/></td>
										</tr>
									
									
										<tr>
											<!-- <td><input onsubmit="saveData('add_school_faculties.php')" type="submit" name="add_school_faculties" value="Add Faculty" /></td>  -->
											<td><button onclick="saveData('add_varisty_campuses.php')"  id="add_varsity_campuses" name="add_varsity_campuses">Add Campus</button></td>
										</tr>
									</table>
							
								<!-- </form> -->
							</div>
							<div id="save_files">
								<form action="fileuploader.php" method="POST" enctype="multipart/form-data">
										<table>
											<tr>
												<td>File simple name</td>
											</tr>
									
											<tr>
												<td><input type="text" name="filename" 
													placeholder="Enter file simple name" /></td>
											</tr>
									
											<tr>
												<td>Description</td>
											</tr>
									
											<tr>
												<td><textarea type="text" name="filedesc"></textarea></td>
											</tr>
									
											<tr>
												<td>File Uploader</td>
											</tr>
									
											<tr>
												<td><input type="text" name="file_uploader"
													placeholder="Enter your name" /></td>
											</tr>
											<tr>
												<td><input type="file" name="user_doc" /></td>
											</tr>
											<tr>
												<td><input type="submit" name="upload_file" value="Upload file" /></td>
											</tr>
										</table>
									
									</form>
								</div>
						</div>
				
				</div>
			
		</div>	
	</div>
</body>

	<head>
		<meta charset="ISO-8859-1">
		<title>Admin Configurator</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
		<script type="text/javascript" src="scripts/admin_data.js"></script>
	</head>
</html>