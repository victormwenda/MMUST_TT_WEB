function getLoadingBitmap(){
	loading ='<div style="padding-right:20%;">';
	loading += '<img style="position:fixed; width:70px; height=:70px; margin:180px 0px 0px 270px;"id="loading_image_big" alt="loading" src="images/ui/progress.gif">';
	loading += '<img style="position:fixed;width:600px; height=:600px;""id="loading_image_big" alt="loading" src="images/ui/loading.png">';
	loading += '</div>';
	
	return loading;
}
function saveAssessments() {
	hideInputFields();
	assessment = document.getElementById('spinner_assessment').value;

	if (assessment == 'select_assessments') {

	}
	if (assessment == 'assessment_assignment') {
		document.getElementById('save_assignment').style.display = "block";
	}
	if (assessment == 'assessment_cat') {
		document.getElementById('save_exams').style.display = "block";
	}
	if (assessment == 'assessments_end_of_sem') {
		document.getElementById('save_exams').style.display = "block";
	}

}
function saveCourses() {
	hideInputFields();
	course = document.getElementById('spinner_courses').value;
	if (course == "select_courses") {

	}
	if (course == "student_courses") {
		document.getElementById('save_courses').style.display = "block";
	}
	if (course == "school_courses") {
		document.getElementById('save_school_courses').style.display = "block";
	}
	if (course == "school_departments") {
		document.getElementById('save_faculty_departments').style.display = "block";
	}
	if (course == "school_faculties") { 
		document.getElementById('save_school_faculties').style.display = "block";
	}
	if (course == "varsity_campuses") { 
		document.getElementById('save_varsity_campuses').style.display = "block";
	}
	
}
function saveScholars() {
	hideInputFields();
	scholar = document.getElementById('spinner_scholars').value;
	
	if (scholar == "select_scholars") {
		
	}
	if (scholar == "save_students") {
		document.getElementById('save_student').style.display = "block";
		
	}
	if (scholar == "save_lecturers") {
		document.getElementById('save_lec').style.display = "block";
	}
}
function saveFiles() {
	hideInputFields();
	files = document.getElementById('spinner_files').value;
	if (files == "select_files_manipulation") {

	}
	if (files == "upload_files") {
		document.getElementById('save_files').style.display = "block";
	}
	if (files == "save_downloads") {
		document.getElementById('save_downloads').style.display = "block";
	}

}
function saveClasses() {
	hideInputFields();
	document.getElementById('save_classes').style.display="block";
	
}

function saveNotifications() {
	hideInputFields();
	document.getElementById('save_notifications').style.display="block";
}
function saveData(url) {
	
	if (window.XMLHttpRequest) {
		xmlHttpRequest = new XMLHttpRequest(); 
		
	} else {
		xmlHttpRequest = new ActieveXObject('Microsoft.XMLHTTP');
		
	}
	xmlHttpRequest.onreadystatechange = function(){
		document.getElementById('commit_result').style.display="block";
		
		if (xmlHttpRequest.readyState == 1 ) {
			document.getElementById('commit_result').innerHTML = '<img src="images/ui/progress.gif" />';
		}
		if (xmlHttpRequest.readyState == 2 ) {
			document.getElementById('commit_result').innerHTML = '<img src="images/ui/progress.gif" />';
		}
		if (xmlHttpRequest.readyState == 3 ) {
			document.getElementById('commit_result').innerHTML = '<img src="images/ui/progress.gif" />';
		}
		if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status==200) {
			document.getElementById('commit_result').style.display="block";
			document.getElementById('commit_result').innerHTML = xmlHttpRequest.responseText;	
			
		}
	}
	params = null;
	xmlHttpRequest.open("POST", url, true);
	xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	/**Assessments*/
	if(url=="save_assignment.php"){
		assignment_no=document.getElementById('assignment_no').value;
		submission_date =document.getElementById('submission_date').value;
		selected_course = document.getElementById('spinner_student_adm_yr_courses').value;
		
		params ="add_assignments=1&assignment_no="+assignment_no+"&submission_date="+submission_date+"&selected_course="+selected_course;
	
	}
	
	/**Classes*/
	if(url=="save_classes.php"){
		
		selected_course = document.getElementById('spinner_student_adm_yr_courses').value;
		selected_lec = document.getElementById('spinner_lec').value;
		class_room = document.getElementById('class_room').value;
		
		monday=document.getElementById('monday').value;
		monday_start=document.getElementById('monday_start').value;
		monday_stop=document.getElementById('monday_stop').value;

		tuesday =document.getElementById('tuesday').value;
		tuesday_start=document.getElementById('tuesday_start').value;
		tuesday_stop=document.getElementById('tuesday_stop').value;
		
		wednesday =document.getElementById('wednesday').value;
		wednesday_start =document.getElementById('wednesday_start').value;
		wednesday_stop=document.getElementById('wednesday_stop').value;

		thursday=document.getElementById('thursday').value;
		thursday_start=document.getElementById('thursday_start').value;
		thursday_stop=document.getElementById('thursday_stop').value;

		friday=document.getElementById('friday').value;
		friday_start=document.getElementById('friday_start').value;
		friday_stop=document.getElementById('friday_stop').value;
		
		params ="add_class=1&selected_lec="+selected_lec
				+"&class_room="+class_room+"&selected_course="+selected_course
				+"&monday="+monday+"&monday_start="+monday_start+"&monday_stop="+monday_stop
				+"&tuesday="+tuesday+"&tuesday_start="+tuesday_start+"&tuesday_stop="+tuesday_stop
				+"&wednesday="+wednesday+"&wednesday_start="+wednesday_start+"&wednesday_stop="+wednesday_stop
				+"&thursday="+thursday+"&thursday_start="+thursday_start+"&thursday_stop="+thursday_stop
				+"&friday="+friday+"&friday_start="+friday_start+"&friday_stop="+friday_stop;
				
	}
	
	
	/**Courses*/
	if(url=="save_courses.php"){
		
		course_code=document.getElementById('course_code').value;
		course_name =document.getElementById('course_name').value;
		course_lec=document.getElementById('course_lec').value;
		student_adm_yr = document.getElementById('spinner_student_adm_yr').value;	
		params = "add_course=1&course_code="+course_code+"&course_name="+course_name+"&course_lec="+course_lec+"&student_adm_yr="+student_adm_yr;
	}
	
	/**Downloads*/
	if(url=="save_downloads.php"){
		add_download  = document.getElementById('add_download').value;
		selected_course = document.getElementById('spinner_student_adm_yr_courses').value;
		selected_file = document.getElementById('selected_file').value;
		params = "add_download=1&selected_course="+selected_course+"&selected_file="+selected_file;
	}
	
	/**Exams*/
	if(url=="save_exams.php"){
		
		exam_type=document.getElementById('exam_type').value;
		exam_date=document.getElementById('exam_date').value;
		exam_start=document.getElementById('exam_start').value;
		exam_duration = document.getElementById('exam_duration').value;
		exam_room = document.getElementById('exam_room').value;
		
		selected_course = document.getElementById('spinner_student_adm_yr_courses').value;
				
		params = "add_exam=1&exam_type="+exam_type+"&selected_course="+selected_course+"&exam_date="+exam_date+"&exam_start="+exam_start+"&exam_duration="+exam_duration+"&exam_room="+exam_room;
	}
	
	/**Lecturer*/
	if(url=="save_lec.php"){
		params = null;
	}
	
	/** Notifications */
	if(url=="save_notifications.php"){
		n_title = document.getElementById('n_title').value;
		n_message = document.getElementById('n_message').value;
		n_sender = document.getElementById('n_sender').value;
		
		cb_campuses = document.getElementById('cb_campuses').checked;
		cb_faculties = document.getElementById('cb_faculties').checked;
		cb_departments = document.getElementById('cb_departments').checked;
		cb_courses = document.getElementById('cb_courses').checked;
		
		params="add_notification=1&n_title="+n_title+"&n_message="+n_message+"&n_sender="+n_sender+"&cb_campuses="+cb_campuses+"&cb_faculties="+cb_faculties+"&cb_departments="+cb_departments+"&cb_courses="+cb_courses;
	}
	
	/** School course*/
	if(url=="add_school_courses.php"){

		course_code=document.getElementById('school_courses_course_code').value;
		course_name=document.getElementById('school_courses_course_name').value;
		
		params = "add_school_courses=1&course_code="+course_code+"&course_name="+course_name;
	}
	
	/** School faculty*/
	if(url=="add_school_faculties.php"){
		faculty_name = document.getElementById('school_faculties_name').value;
		params = "add_school_faculties=1&faculty_name="+faculty_name;
	}
	/** School faculty*/
	if(url=="add_varisty_campuses.php"){
		campus_name = document.getElementById('varisty_campus_name').value;
		params = "add_varsity_campuses=1&campus_name="+campus_name;
	}
	
	/** School department*/
	if(url=="add_school_departments.php"){
		
		department_name = document.getElementById('school_department_name').value;
		
		params = "add_school_departments=1"+"&department_name="+department_name;
	}
	
	/** Student*/
	if(url=="add_student.php"){
			reg_no = document.getElementById('student_reg_no').value;
			full_name= document.getElementById('student_full_name').value;
			phonenumber= document.getElementById('student_phonenumber').value;
			email= document.getElementById('student_email').value;
			student_category= document.getElementById('student_student_category').value;
			
			params = "add_student=1" +"&reg_no="+reg_no+"&full_name="+full_name+"&phonenumber="+phonenumber+"&email="+email+"&student_category="+student_category;
	
	}
	

	campus = document.getElementById('campus_spinner').value;
	faculty = document.getElementById('faculty_spinner').value;
	department = document.getElementById('department_spinner').value;
	course = document.getElementById('courses_spinner').value;
	student_adm_yr =  document.getElementById('spinner_student_adm_yr').value;
	
	params += "&campus="+campus+"&faculty="+faculty+"&department="+department+"&course="+course+"&student_adm_yr="+student_adm_yr
	xmlHttpRequest.send(params);
}

window.onload = function(){
	
	document.getElementById('admin_navigation').style.display="none";
	document.getElementById('parent_log_in').style.display="block";
	document.getElementById('log_out').style.display="none";
	document.getElementById('course_select_hierachy').style.display="none";
		
	requestLogIn();
	hideInputFields();
	
	document.getElementById('campus_spinner').style.display="none";
	document.getElementById('faculty_spinner').style.display="none";
	document.getElementById('department_spinner').style.display="none";
	document.getElementById('courses_spinner').style.display="none";
	getSpinnerData("campus");
}

function hideInputFields(){
	document.getElementById('save_assignment').style.display="none";
	document.getElementById('save_classes').style.display="none";
	document.getElementById('save_courses').style.display="none";
	document.getElementById('save_downloads').style.display="none";
	document.getElementById('save_exams').style.display="none";
	document.getElementById('save_lec').style.display="none";
	document.getElementById('save_notifications').style.display="none";
	document.getElementById('save_student').style.display="none";
	document.getElementById('save_school_courses').style.display="none";
	document.getElementById('save_faculty_departments').style.display = "none";
	document.getElementById('save_school_faculties').style.display = "none";
	document.getElementById('save_varsity_campuses').style.display = "none";
	document.getElementById('save_files').style.display="none";
	document.getElementById('commit_result').style.display="none";
	
}
function requestLogOut(){
	if(window.XMLHttpRequest){
		request = new XMLHttpRequest();
	}else{ request = new ActieveXObject('Microsoft.XMLHTTP');}
	
	request.onreadystatechange = function (){
		if(request.status == 200 && request.readyState==4){
			
			if(request.responseText=="0"){
				document.getElementById('parent_log_in').style.display="none";
				document.getElementById('log_out').style.display="block";
				alert("Log out failed");
			}
			if(request.responseText=="1"){
				document.getElementById('parent_log_in').style.display="block";
				document.getElementById('log_out').style.display="none";
				
				document.getElementById('student_details').style.display="none";
				
				document.getElementById('admin_navigation').style.display="none";
				
				document.getElementById('course_select_hierachy').style.display="none";
			}
		}
	}
	
	request.open("POST", 'log_out_admin.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("");
}
function requestLogIn(){
	if(window.XMLHttpRequest){
		request = new XMLHttpRequest();
	}else{ request = new ActieveXObject('Microsoft.XMLHTTP');}
	
	request.onreadystatechange = function (){
		if(request.status == 200 && request.readyState==4){
			
			if(request.responseText=="0"){
				document.getElementById('parent_log_in').style.display="block";
				
				
				
			}
			if(request.responseText=="1"){
				document.getElementById('log_out').style.display="inline";
				document.getElementById('parent_log_in').style.display="none";
				document.getElementById('admin_navigation').style.display="block";
				document.getElementById('course_select_hierachy').style.display="block";
				
			}
		}
	}
	
	request.open("POST", 'validate_admin.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("");
}
function auth(){
	
	username = document.getElementById('input_admin_username').value;
	password = document.getElementById('input_admin_password').value;
	
	if(window.XMLHttpRequest){
		request = new XMLHttpRequest(); 
	}else{ request   = new ActieveXObject('Microsoft.XMLHTTP');}
	
	request.onreadystatechange = function (){
		if(request.status == 200 && request.readyState==4){
			
			if(request.responseText=="0"){
				document.getElementById('admin_navigation').style.display="none";
				document.getElementById('login_response').innerHTML='<span style="color:#FFFFFF;font-family:Arial;">Oops! Login failed,You are not an admin</span>';
			}
			if(request.responseText=="1"){
				document.getElementById('parent_log_in').style.display="none";
				document.getElementById('admin_navigation').style.display="block";
				document.getElementById('student_details').style.display="block";
				document.getElementById('log_out').style.display="inline";
				document.getElementById('course_select_hierachy').style.display="block";
			}
		}
	}
	
	request.open("POST", 'admin_login.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("login_admin=1&username="+username+"&password="+password);
}
function onCampusSelected(){
	getSpinnerData('faculty'); 
	
}

function onFacultySelected(){
	getSpinnerData('department'); //Takes the url for the responsible script file
	
}
function onDepartmentSelected(){
	getSpinnerData('courses');
}
function onCourseSelected(){
	getSpinnerData('student_adm_yr');
	
}
function onStudentAdmYrSelected(){
	getSpinnerData('student_adm_yr_courses');
}

function onStudentAdmYrCoursesSelected(){
	
}
function getSpinnerData(spinner){ //Loads spinner data for the passed spinner
	if(window.XMLHttpRequest){
		xmlRequest = new XMLHttpRequest();
		}else{
			xmlRequest = new ActieveXObject('Microsoft.XMLHTTP');
		}

	xmlRequest.onreadystatechange = function(){
		if(xmlRequest.readyState==4&&xmlRequest.status==200){
		
				if(spinner=="campus"){
					document.getElementById('campus_spinner').style.display="block";
					document.getElementById('campus_spinner').innerHTML=xmlRequest.responseText;

					document.getElementById('faculty_spinner').style.display="none";
					document.getElementById('department_spinner').style.display="none";
					document.getElementById('courses_spinner').style.display="none";
					document.getElementById('spinner_student_adm_yr').style.display="block";
					document.getElementById('div_student_adm_yr').style.display="block";

					}
				if(spinner=="faculty"){
					document.getElementById('faculty_spinner').style.display="block";

					document.getElementById('department_spinner').style.display="none";
					document.getElementById('courses_spinner').style.display="none";
					document.getElementById('spinner_student_adm_yr').style.display="block";
					document.getElementById('div_student_adm_yr').style.display="block";
					
					document.getElementById('faculty_spinner').innerHTML=xmlRequest.responseText;
					}
				if(spinner=="department"){
					document.getElementById('department_spinner').style.display="block";
					document.getElementById('courses_spinner').style.display="none";
					document.getElementById('spinner_student_adm_yr').style.display="block";
					document.getElementById('div_student_adm_yr').style.display="block";
					
					document.getElementById('department_spinner').innerHTML=xmlRequest.responseText;
					}
				if(spinner=="courses"){
					document.getElementById('courses_spinner').style.display="block";
					document.getElementById('spinner_student_adm_yr').style.display="block";
					document.getElementById('div_student_adm_yr').style.display="block";
					
					document.getElementById('courses_spinner').innerHTML=xmlRequest.responseText;
				}
				
				if(spinner=="student_adm_yr"){
					document.getElementById('div_student_adm_yr').style.display="block";
					document.getElementById('spinner_student_adm_yr').style.display="block";
					document.getElementById('spinner_student_adm_yr_courses').style.display="none";
				}
				if(spinner=="student_adm_yr_courses"){
					
					document.getElementById('campus_spinner').style.display="block";
					document.getElementById('faculty_spinner').style.display="block";
					document.getElementById('department_spinner').style.display="block";
					document.getElementById('courses_spinner').style.display="block";
					
					document.getElementById('spinner_student_adm_yr_courses').style.display="block";
					document.getElementById('spinner_student_adm_yr_courses').innerHTML=xmlRequest.responseText;
					
					
				}
				
		}
	}
	campus = document.getElementById('campus_spinner').value;
	faculty = document.getElementById('faculty_spinner').value;
	department = document.getElementById('department_spinner').value;
	course = document.getElementById('courses_spinner').value;
	student_adm_yr =  document.getElementById('spinner_student_adm_yr').value;
	
	
	if(spinner=="campus"){
		params="spinner="+spinner;
		}
	if(spinner=="faculty"){
		params = "spinner="+spinner +"&campus="+campus;
		}
	if(spinner=="department"){
		params = "spinner="+spinner +"&campus="+campus +"&faculty="+faculty;
		}
	if(spinner=="courses"){
		params = "spinner="+spinner +"&campus="+campus +"&faculty="+faculty+"&department="+department;
		}
	if(spinner=="student_adm_yr_courses"){
		params = "spinner="+spinner +"&campus="+campus +"&faculty="+faculty+"&department="+department+"&course="+course+"&student_adm_yr="+student_adm_yr;
	}
	
	xmlRequest.open("POST", "get_spinner_data.php", true);
	xmlRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlRequest.send(params);
}