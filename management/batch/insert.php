<?php
	include "../../common/header.php";



	$fields = array('code', 'title', 'description', 'class_limit', 'trainer_id', 'course_id');
	$values = array($_POST['code'], $_POST['title'], $_POST['description'], $_POST['limit'], $_POST['trainer_id'], $_POST['course_id']);
	$new_id = insertNew($conn, "batches", $fields, $values);
	if($new_id){
		$_SESSION['success'] = "Batch created successfully";
		goToError($base_url."/management/batch/manage.php");
	}else{
		$_SESSION['error'] = "Falied To insert batch";
		goToError($base_url."/management/batch/add.php");
	}