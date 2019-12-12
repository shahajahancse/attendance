<?php 

include "common/global_config.php";
include "common/mysql_connect.php";
include "common/query_builder.php";

	$fields = array('name', 'msisdn', 'email', 'password');
	$values = array($_POST['name'], $_POST['msisdn'], $_POST['email'], md5($_POST['password']));
	$new_id = insertNew($conn, "users", $fields, $values);

	if($new_id){
		$_SESSION['success'] = "User Sign Up successfully";
		goToError("index.php");
	}else{
		$_SESSION['error'] = "Signup Failed !";
		goToError("signup.php");
	}


 ?>