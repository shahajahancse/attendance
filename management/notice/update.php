<?php 
include '../../common/header.php';

if (isset($_POST['id'])) {

	$fields = array('created_by', 'notice_type_id',	'title', 'description',	'batch_id',	'start_at',	'finish_at');
	$values = array($_POST['created_by'], $_POST['notice_type'], $_POST['notice_title'], $_POST['notice_description'], $_POST['batch'], $_POST['start_at'], $_POST['finish_at']);



	$id = $_POST['id'];

	$condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);
	$notices = selectSingleTableWithOneCondition($conn, 'notices', $condition);
	if(mysqli_num_rows($notices) > 0){
			    
						$notices = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);
						$result = updateRowWithOneCondition($conn, "notices", $fields, $values, $notices);

						if($result == 1){
							$_SESSION['success'] = "Notice updated successfully";
							goToError($base_url."/management/notice/manage.php");
						}else{
							$_SESSION['error'] = "Failed to update Notice";
							goToError($base_url."/management/notice/edit.php?id=".$id);
						}
				}else{
					goToError($base_url."/common/403.php");
				 }
}