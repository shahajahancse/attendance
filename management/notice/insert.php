<?php 
include "../../common/header.php";


if (isset($_POST)) {
	$fields = array('created_by', 'notice_type_id',	'title', 'description',	'batch_id',	'start_at',	'finish_at');
	$values = array($_POST['created_by'], $_POST['notice_type'], $_POST['notice_title'], $_POST['notice_description'], $_POST['batch'], $_POST['start_at'], $_POST['finish_at']);
	$new_id = insertNew($conn, 'notices', $fields, $values);

	if($new_id){
		$_SESSION['success'] = "Notice created successfully";
		goToError($base_url."/management/notice/manage.php");
	}else{
		$_SESSION['error'] = "Failed to insert notice";
		goToError($base_url."/management/notice/add.php");
	}


}else{
		$_SESSION['error'] = "You Don't have permission to see this page";
		goToError($base_url."/management/notice/add.php");
}


 ?>