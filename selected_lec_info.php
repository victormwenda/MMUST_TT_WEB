<?php
$lec_id =$_POST['lec_id'];
require 'db_auth.php';
$query = "SELECT  * FROM lecturer,courses where `lecturer`.`lec_id` =`courses`.`lec_id` ";
if($result = mysqli_query($conn, $query)){

	while($lec_info = mysqli_fetch_assoc($result)){
		$lec_id= $lec_info['lec_id'];
		$lec_name= $lec_info['lec_name'];
		$course_name=$lec_info['course_name'];
		showLec($lec_id,$lec_name,$course_name);
	}
}

function showLecInfo($lec_name,$lec_email,$lec_phone,$lec_qualifications){
	echo '<div><img alt="lec_avator" src="uploads/images/avators/lec/victor.jpg" style="width:120px; height:150px; border:1px solid #ccc;border-radius:5px; padding:3px;">
	<p style="float:right;"><label>Name : '.$lec_name.'</label><br />
	<label>Email : '.$lec_email.'</label><br />
	<label>Phonenumber : '.$lec_phone.'</label></p></div>
	<br /><label>Qualifications<br />'.$lec_qualifications.'</label>';
}
?>