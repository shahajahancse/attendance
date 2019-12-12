<?php 
	include '../common/header.php';

 ?>

 <?php if (isset($_GET['approve'])) {

 	$id = $_GET['approve'];

 	$fields = array('approved');

 	$values = array(1);

 	$condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);

 	$result = updateRowWithOneCondition($conn, "attendances", $fields, $values, $condition);


 	if($result == 1){
    $_SESSION['success'] = "Approved Successfully";
    goToError($base_url."/trainer/home.php");
  }else{
    $_SESSION['error'] = "Something Went Wrong ! Plese try again";
    goToError($base_url."/trainer/home.php");
  }


 }elseif (isset($_GET['reject'])) {
 	$id = $_GET['reject'];

 	$fields = array('approved');

 	$values = array(2);

 	$condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);

 	$result = updateRowWithOneCondition($conn, "attendances", $fields, $values, $condition);


 	if($result == 1){
    $_SESSION['success'] = "Rejected Successfully";
    goToError($base_url."/trainer/home.php");
  }else{
    $_SESSION['error'] = "Something Went Wrong ! Plese try again";
    goToError($base_url."/trainer/home.php");
  }

 }else{
 	$_SESSION['error'] = "You Can't View This Page";
		goToError($base_url."/trainer/home.php");
 } 

 ?>





