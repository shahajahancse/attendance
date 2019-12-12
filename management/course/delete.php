<?php
	include "../../common/header.php";

	$course_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_GET['id']);
	$result = deleteRowWithOneCondition($conn, "courses", $course_condition);

	if($result == 1){
		$_SESSION['success'] = "Course deleted successfully";
		goToError($base_url."/management/course/manage.php");
	}else{
		$_SESSION['error'] = "Failed to delete course";
		goToError($base_url."/management/course/manage.php");
	}