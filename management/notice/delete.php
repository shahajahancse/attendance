<?php 
include '../../common/header.php';
if (isset($_GET['id'])) {
	$condition = array('field_name' => 'id', 'condition' => 'eqal', 'field_value' => $_GET['id']);
	$result = deleteRowWithOneCondition($conn, 'notices', $condition);

	if($result == 1){
				$_SESSION['success'] = "Notice deleted successfully";
				goToError($base_url."/management/notice/manage.php");
			}else{
				$_SESSION['error'] = "Failed to delete Notice";
				goToError($base_url."/management/notice/manage.php");
			}
}else{
	goToError($base_url."/common/403.php");
}



 ?>