<?php
	include "../../common/header.php";

	$fields = array('code', 'title', 'description', 'number_of_class', 'duration');
		$values = array($_POST['code'], $_POST['title'], $_POST['description'], $_POST['number_of_class'], $_POST['duration']);

	$id = $_POST['id'];

	$course_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);
	$result = updateRowWithOneCondition($conn, "courses", $fields, $values, $course_condition);

	if($result == 1){
		$_SESSION['success'] = "course updated successfully";
		goToError($base_url."/management/course/manage.php");
	}else{
		$_SESSION['error'] = "Failed to update course";
		goToError($base_url."/management/course/edit.php?id=".$id);
	}