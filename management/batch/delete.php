<?php
	include "../../common/header.php";


  if(!isset($_GET['id']) || $_GET['id'] == ""){
    goToError($base_url."/common/403.php");
  }


  
	$course_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_GET['id']);
	$result = deleteRowWithOneCondition($conn, "batches", $course_condition);

	if($result == 1){
		$_SESSION['success'] = "Batch deleted successfully";
		goToError($base_url."/management/batch/manage.php");
	}else{
		$_SESSION['error'] = "Failed to delete batch";
		goToError($base_url."/management/batch/manage.php");
	}