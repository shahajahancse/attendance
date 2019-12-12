<?php
	include "../../common/header.php";

	$fields = array('code', 'title', 'description', 'number_of_class', 'duration');
	$values = array($_POST['code'], $_POST['title'], $_POST['description'], $_POST['number_of_class'], $_POST['duration']);
	$new_id = insertNew($conn, "courses", $fields, $values);

	if($new_id){
		$_SESSION['success'] = "Course created successfully";
		goToError($base_url."/management/course/manage.php");
	}else{
		$_SESSION['error'] = "Failed to insert course";
		goToError($base_url."/management/course/add.php");
	}