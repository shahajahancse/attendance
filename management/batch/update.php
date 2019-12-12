<?php
  include "../../common/header.php";

  $fields = array('code', 'title', 'description', 'class_limit', 'trainer_id','course_id');
  $values = array($_POST['code'], $_POST['title'], $_POST['description'], $_POST['limit'], $_POST['trainer_id'], $_POST['course_id']);


  $id = $_POST['id'];

  $course_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);
  $result = updateRowWithOneCondition($conn, "batches", $fields, $values, $course_condition);

  // print_r($course_condition); exit;

  if($result == 1){
    $_SESSION['success'] = "course updated successfully";
    goToError($base_url."/management/batch/manage.php");
  }else{
    $_SESSION['error'] = "Failed to update course";
    goToError($base_url."/management/batch/edit.php?id=".$id);
  }