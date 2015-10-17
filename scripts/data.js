/**
 * Read Courses Ajax
 */
function getLoadingBitmap(){
	loading ='<div style="padding-right:20%;">';
	loading += '<img style="position:fixed; width:70px; height=:70px; margin:120px 0px 0px 300px;"id="loading_image_big" alt="loading" src="images/ui/progress.gif">';
	loading += '<img style="display:none;position:fixed;width:600px; height=:600px;""id="loading_image_big" alt="loading" src="images/ui/loading.png">';
	loading += '</div>';
	
	return loading;
}
function readData(url) {
	
	if (window.XMLHttpRequest) {
		xmlHttpRequest = new XMLHttpRequest(); 
		
	} else {
		xmlHttpRequest = new ActieveXObject('Microsoft.XMLHTTP');
		
	}
	xmlHttpRequest.onreadystatechange = function(){
		if (xmlHttpRequest.readyState == 1 ) {
			document.getElementById('requested_data').innerHTML = getLoadingBitmap();
		}
		if (xmlHttpRequest.readyState == 2 ) {
			document.getElementById('requested_data').innerHTML = getLoadingBitmap();
		}
		if (xmlHttpRequest.readyState == 3 ) {
			document.getElementById('requested_data').innerHTML = getLoadingBitmap();
		}
		if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status==200) {
			
			/* Notifications*/
			if(url=="read_notifications.php"){
				document.getElementById('wrapper_notifications').innerHTML = xmlHttpRequest.responseText;
				readData('read_classes.php');
			}else{
				document.getElementById('requested_data').innerHTML = xmlHttpRequest.responseText;
			}
			
			/**Classes*/
			if(url=="read_classes.php"){
				document.getElementById('weekdays').style.display="block";
			}else{document.getElementById('weekdays').style.display="none";}
			
			/**Assessments*/
			if(url=="read_assessments.php"){
				document.getElementById('assessments').style.display="block";
			}else{document.getElementById('assessments').style.display="none";}
			
			
		}
		
	}
	params = "client=desktop";
	xmlHttpRequest.open("POST", url, true);
	xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	/**Courses*/
	if(url=="read_courses.php"){
		//params += null;
	}
	
	/**Classes*/
	if(url=="read_classes.php"){
		params += "&selected_day="+document.getElementById('selected_day').value;
	}else{document.getElementById('weekdays').style.display="none";}
	
	/**Assessments*/
	if(url=="read_assessments.php"){
		params += "&assessment="+document.getElementById('assessment').value;
	}else{document.getElementById('assessments').style.display="none";}
	
	/**Lecturer*/
	if(url=="read_lecturer.php"){
		//params+ = null;
	}
	
	/**Notifications*/
	if(url=="read_notifications.php"){
		//params += null;
	}
	
	/**Files Info (Downloads and Uploads*/
	if(url=="read_downloads.php"){
		params += "&read_downloads=read_downloads";
	}
	
	xmlHttpRequest.send(params);
}

window.onload = function(){
	
	document.getElementById('notifications').style.display="none";
	
	requestLogIn();

	document.getElementById('weekdays').style.display="none";
	document.getElementById('assessments').style.display="none";
	document.getElementById('parent_log_in').style.display="block";
	document.getElementById('log_out').style.display="none";
	
	
	
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
				document.getElementById('notifications').style.display="block";
			}
			if(request.responseText=="1"){
				document.getElementById('parent_log_in').style.display="block";
				document.getElementById('log_out').style.display="none";
				
				document.getElementById('student_details').style.display="none";
				
				document.getElementById('navigation').style.display="none";
				document.getElementById('notifications').style.display="none";
				
			}
		}
	}
	
	request.open("POST", 'log_out.php', true);
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
				
				document.getElementById('navigation').style.display="none";
				document.getElementById('notifications').style.display="none";
			}
			if(request.responseText=="1"){
				document.getElementById('notifications').style.display="block";
				document.getElementById('log_out').style.display="inline";
				document.getElementById('parent_log_in').style.display="none";
				readData('read_notifications.php');
				
			}
		}
	}
	
	request.open("POST", 'validate_user.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("");
}
function auth(){
	
	reg_no = document.getElementById('input_reg_no').value;
	email = document.getElementById('input_email').value;
	
	if(window.XMLHttpRequest){
		request = new XMLHttpRequest(); 
	}else{ request   = new ActieveXObject('Microsoft.XMLHTTP');}
	
	request.onreadystatechange = function (){
		if(request.status == 200 && request.readyState==4){
			
			if(request.responseText=="0"){
				document.getElementById('login_response').innerHTML='<span style="color:#FFFFFF;font-family:Arial;">Oops! Login failed, Contact the admin</span>';
			}
			if(request.responseText=="1"){
				document.getElementById('navigation').style.display="inline";
				document.getElementById('notifications').style.display="inline";
				
				document.getElementById('log_out').style.display="inline";
				document.getElementById('parent_log_in').style.display="none";
				
				document.getElementById('student_details').style.display="inline";
			}
		}
	}
	
	request.open("POST", 'login.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("login_student=1&reg_no="+reg_no+"&email="+email);
}