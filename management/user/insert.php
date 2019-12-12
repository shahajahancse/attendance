<?php
	include "../../common/header.php";

	$fields = array('name', 'msisdn', 'email', 'password', 'role_id');
	$values = array($_POST['name'], $_POST['msisdn'], $_POST['email'], md5($_POST['password']), $_POST['role_id']);
	$new_id = insertNew($conn, "users", $fields, $values);

	if($new_id){
		$_SESSION['success'] = "User created successfully";
		goToError($base_url."/management/user/manage.php");
	}else{
		$_SESSION['error'] = "Failed to insert user";
		goToError($base_url."/management/user/add.php");
	}