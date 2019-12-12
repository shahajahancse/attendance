<?php 
include "../../common/header.php";


if (isset($_POST)) {

	$fields = array('user_id', 'batch_id',	'rating', 'review', 'date');
	$values = array($_POST['user_id'], $_POST['batch_id'], $_POST['rating'], $_POST['review'], date('Y-m-d'));
	$new_id = insertNew($conn, 'attendances', $fields, $values);

	$full_course_text = "";

	if(isset($_POST['own_rating']) && $_POST['own_rating'] != ''){

		$fields = array('own_rating', 'own_review');
		$values = array($_POST['own_rating'], $_POST['own_review']);

		$condition_one = array('field_name' => 'batch_id', 'condition' => 'equal', 'field_value' => $_POST['batch_id']);
		$condition_two = array('field_name' => 'user_id', 'condition' => 'equal', 'field_value' => $_POST['user_id']);
		$result = updateRowWithTwoCondition($conn, "user_batch", $fields, $values, $condition_one, $condition_two);

		if($result == 1){
			$full_course_text = "Course rating updated successfully.";
		}else{
			$full_course_text = "Failed to update Course rating.";
		}

	}

	if($new_id){
		$_SESSION['success'] = "Attendance created successfully. ".$full_course_text;
		goToError($base_url."/student/attendance/add.php");
	}else{
		$_SESSION['error'] = "Failed to insert attendance. ".$full_course_text;
		goToError($base_url."/student/attendance/add.php");
	}


}else{
		$_SESSION['error'] = "You Don't have permission to see this page";
		goToError($base_url."/student/attendance/add.php");
}


 ?>