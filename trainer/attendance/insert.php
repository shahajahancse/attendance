<?php 
	include '../../common/header.php';
	if (isset($_POST['user_id'])) {
			$fields = array('user_id', 'batch_id', 'rating', 'review', 'date');
			$values = array($_POST['user_id'], $_POST['batch_id'], $_POST['rating'], $_POST['review'], date('Y-m-d'));
			$new_id= insertNew($conn, 'attendances', $fields, $values);



			if($new_id){
		$_SESSION['success'] = "Attendance created successfully. ".$full_course_text;
		goToError($base_url."/trainer/attendance/add.php");
		
	}else{
		$_SESSION['error'] = "Failed to insert attendance. ".$full_course_text;
		goToError($base_url."/trainer/attendance/add.php");
	}


	}else{
		$_SESSION['error'] = "You Don't have permission to see this page";
		goToError($base_url."/trainer/attendance/add.php");
	}




 ?>