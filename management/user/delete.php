<?php
	include "../../common/header.php";

	if(!isset($_GET['id']) || $_GET['id'] == ""){
	    goToError($base_url."/common/403.php");
	}

	$user_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_GET['id']);
	$user = selectSingleTableWithOneCondition($conn, 'users', $user_condition);
	if(mysqli_num_rows($user) > 0){

		$user_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_GET['id']);
		$result = deleteRowWithOneCondition($conn, "users", $user_condition);

		if($result == 1){
			$_SESSION['success'] = "User deleted successfully";
			goToError($base_url."/management/user/manage.php");
		}else{
			$_SESSION['error'] = "Failed to delete user";
			goToError($base_url."/management/user/manage.php");
		}

	}else{
	    $_SESSION['error'] = "No user found with this ID";
		goToError($base_url."/management/user/manage.php");
	}