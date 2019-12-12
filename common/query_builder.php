<?php

	function conditionDefine($element){

		switch ($element["condition"]) {
			case 'equal':
					$text = $element["field_name"].' = "'.$element["field_value"].'"';
				break;

			case 'not_equal':
					$text = $element["field_name"].' != "'.$element["field_value"].'"';
				break;
			
			default:
					$text = $element["field_name"].' = "'.$element["field_value"].'"';
				break;
		}

		return $text;
	}

	function selectSingleTableWithTwoCondition($conn, $table_name, $condition_one, $condition_two){

		$sql = "SELECT * FROM $table_name
					WHERE ".conditionDefine($condition_one)."
					AND ".conditionDefine($condition_two);

		return $result = mysqli_query($conn, $sql);

	}
function selectSingleTableWithThreeCondition($conn, $table_name, $condition_one, $condition_two, $condition_three){

		$sql = "SELECT * FROM $table_name
					WHERE ".conditionDefine($condition_one)."
					AND ".conditionDefine($condition_two)."
					AND ".conditionDefine($condition_three);

		return $result = mysqli_query($conn, $sql);

	}

	function selectSingleTableWithNoCondition($conn, $table_name){

		$sql = "SELECT * FROM $table_name";

		return $result = mysqli_query($conn, $sql);

	}

	function selectSingleTableWithOneCondition($conn, $table_name, $condition){

		$sql = "SELECT * FROM $table_name
					WHERE ".conditionDefine($condition);

		return $result = mysqli_query($conn, $sql);

	}

	function insertNew($conn, $table_name, $fields, $values){

		$fields_text = "";
		$last_i = count($fields) - 1;

		$values_text = "";
		$last_j = count($values) - 1;

		for ($i=0; $i < count($fields); $i++) { 
			if($i == $last_i){
				$comma = "";
			}else{
				$comma = ",";
			}
			$fields_text = $fields_text.$fields[$i].$comma;
		}

		for ($j=0; $j < count($values); $j++) { 
			if($j == $last_j){
				$comma = "";
			}else{
				$comma = ",";
			}
			$values_text = $values_text.'"'.$values[$j].'"'.$comma;
		}

		$sql = "INSERT INTO $table_name 
				(".$fields_text.")
				VALUES 
				(".$values_text.")";

		return $result = mysqli_query($conn, $sql);

	}

	function updateRowWithOneCondition($conn, $table_name, $fields, $values, $condition){

		if(count($fields) == count($values)){

			$text = "";
			$last_i = count($fields) - 1;

			for ($i=0; $i < count($fields); $i++) { 
				if($i == $last_i){
					$comma = "";
				}else{
					$comma = ",";
				}
				
				$text = $text.$fields[$i].'="'.$values[$i].'"'.$comma;
			}

			$sql = "UPDATE $table_name
						SET ".$text."
						WHERE ".conditionDefine($condition);

			return $result = mysqli_query($conn, $sql);

		}else{
			return 0;
		}

	}

	function updateRowWithTwoCondition($conn, $table_name, $fields, $values, $condition_one, $condition_two){

		if(count($fields) == count($values)){

			$text = "";
			$last_i = count($fields) - 1;

			for ($i=0; $i < count($fields); $i++) { 
				if($i == $last_i){
					$comma = "";
				}else{
					$comma = ",";
				}
				
				$text = $text.$fields[$i].'="'.$values[$i].'"'.$comma;
			}

			$sql = "UPDATE $table_name
						SET ".$text."
						WHERE ".conditionDefine($condition_one)."
						AND ".conditionDefine($condition_two);

			return $result = mysqli_query($conn, $sql);

		}else{
			return 0;
		}

	}

	function deleteRowWithOneCondition($conn, $table_name, $condition){

		$sql = "DELETE FROM $table_name
					WHERE ".conditionDefine($condition);

		return $result = mysqli_query($conn, $sql);

	}

	function selectUserList($conn, $get_data = null){

		if (empty($get_data)) {
			
			$sql = "SELECT 
				users.id, users.name, users.msisdn, users.email, users.role_id, roles.title
				FROM users
				JOIN roles ON users.role_id = roles.id";

		}else{
			
			$sql = "SELECT 
				users.id, users.name, users.msisdn, users.email, users.role_id, roles.title
				FROM users
				JOIN roles ON users.role_id = roles.id";

			// echo count($get_data);

			$conditions = array();

			if(array_key_exists('name', $get_data) && $get_data['name'] != ''){
				$conditions[] = 'users.name LIKE "%'.$get_data['name'].'%"';
			}

			if(array_key_exists('msisdn', $get_data) && $get_data['msisdn'] != ''){
				$conditions[] = 'users.msisdn LIKE "%'.$get_data['msisdn'].'%"';
			}

			if(array_key_exists('email', $get_data) && $get_data['email'] != ''){
				$conditions[] = 'users.email LIKE "%'.$get_data['email'].'%"';
			}

			if(array_key_exists('role_id', $get_data) && $get_data['role_id'] != ''){
				$conditions[] = 'users.role_id = '.$get_data['role_id'];
			}

			if(array_key_exists('status', $get_data) && $get_data['status'] != ''){
				$conditions[] = 'users.status = '.$get_data['status'];
			}

			for ($i=0; $i < count($conditions); $i++) { 
				if($i == 0){
					$keyword = "WHERE";
				}else{
					$keyword = "AND";
				}

				$sql = $sql.' '.$keyword.' '.$conditions[$i];

			}

		}

		return $result = mysqli_query($conn, $sql);

	}

	function selectBatchList($conn, $table_name, $get_data = null){

		if (empty($get_data)) {
			$sql = "SELECT 
				batches.id, batches.code, batches.title, batches.class_limit, users.name, courses.title AS cname
				FROM batches
				JOIN users ON batches.trainer_id = users.id
				JOIN courses ON batches.course_id = courses.id";
		}else{
			$sql = "SELECT 
				batches.id, batches.code, batches.title, batches.class_limit, users.name, courses.title AS cname
				FROM batches
				JOIN users ON batches.trainer_id = users.id
				JOIN courses ON batches.course_id = courses.id";

				$conditions = array();

			if(array_key_exists('code', $get_data) && $get_data['code'] != ''){
				$conditions[] = 'batches.code LIKE "%'.$get_data['code'].'%"';
			}

			if(array_key_exists('title', $get_data) && $get_data['title'] != ''){
				$conditions[] = 'courses.title LIKE "%'.$get_data['title'].'%"';
			}

			if(array_key_exists('trainer_id', $get_data) && $get_data['trainer_id'] != ''){
				$conditions[] = 'batches.trainer_id = '.$get_data['trainer_id'];
			}

			if(array_key_exists('id', $get_data) && $get_data['course_id'] != ''){
				$conditions[] = 'courses.id = '.$get_data['course_id'];
			}

			if(array_key_exists('status', $get_data) && $get_data['status'] != ''){
				$conditions[] = 'batches.status = '.$get_data['status'];
			}

			for ($i=0; $i < count($conditions); $i++) { 
				if($i == 0){
					$keyword = "WHERE";
				}else{
					$keyword = "AND";
				}

			$sql = $sql.' '.$keyword.' '.$conditions[$i];

			}

		}

		return $result = mysqli_query($conn, $sql);

// code
// title
// trainer
// name
// status

	}

	function selectCourseList($conn, $table_name, $get_data = null){

		if (empty($get_data)) {
			
			$sql = "SELECT * FROM $table_name";

		}else{

			$sql = "SELECT * FROM $table_name";

			$conditions = array();

			if(array_key_exists('code', $get_data) && $get_data['code'] != ''){
				$conditions[] = 'code LIKE "%'.$get_data['code'].'%"';
			}

			if(array_key_exists('title', $get_data) && $get_data['title'] != ''){
				$conditions[] = 'title LIKE "%'.$get_data['title'].'%"';
			}

			if(array_key_exists('number_of_class', $get_data) && $get_data['number_of_class'] != ''){
				$conditions[] = 'number_of_class = '.$get_data['number_of_class'];
			}

			if(array_key_exists('duration', $get_data) && $get_data['duration'] != ''){
				$conditions[] = 'duration = '.$get_data['duration'];
			}

			for ($i=0; $i < count($conditions); $i++) { 
				if($i == 0){
					$keyword = "WHERE";
				}else{
					$keyword = "AND";
				}

				$sql = $sql.' '.$keyword.' '.$conditions[$i];

			}
			
		}

		return $result = mysqli_query($conn, $sql);

	}

	function selectNoticeList($conn, $get_data = null){

		if (empty($get_data)) {
			$sql = "SELECT 
				notices.id AS notice_id, notices.created_by, notices.notice_type_id, notices.title, notices.description, notices.batch_id, notices.start_at, notices.finish_at, users.name, batches.title AS batch_title
				FROM notices
				LEFT JOIN users ON notices.created_by = users.id
				LEFT JOIN batches ON notices.batch_id = batches.id";
		}else{
			$sql = "SELECT 
				notices.id AS notice_id, notices.created_by, notices.notice_type_id, notices.title, notices.description, notices.batch_id, notices.start_at, notices.finish_at, users.name, batches.title AS batch_title
				FROM notices
				LEFT JOIN users ON notices.created_by = users.id
				LEFT JOIN batches ON notices.batch_id = batches.id";

				$condition = array();

				if(array_key_exists('role_id', $get_data) && $get_data['role_id'] != ''){
					$condition[] = 'notices.created_by ='.$get_data['role_id'];
				}
				if(array_key_exists('title', $get_data) && $get_data['title'] != ''){
					$condition[] = 'notices.title LIKE "%'.$get_data['title'].'%"';
				}
				if (array_key_exists('description', $get_data) && $get_data['description'] != '') {
					$condition[] = 'notices.description  LIKE "%'.$get_data['description'].'%"';

				}
				if (array_key_exists('batch_id', $get_data) && $get_data['batch_id'] != '') {
					$condition[] = 'notices.batch_id ='.$get_data['batch_id'];
				}
				if (array_key_exists('status', $get_data) && $get_data['status'] != '') {
					$condition[] = 'notices.status ='.$get_data['status'];
				}
				if (array_key_exists('start_at', $get_data) && $get_data['start_at'] != '') {
					$condition[] = 'notices.start_at LIKE "%'.$get_data['start_at'].'%"';
				}
				if (array_key_exists('finish_at', $get_data) && $get_data['finish_at'] != '') {
					$condition[] = 'notices.finish_at LIKE "%'.$get_data['finish_at'].'%"';
				}

				for ($i=0; $i < count($condition); $i++) { 
					if ($i == 0) {
						$keyword = "WHERE";
					}else{
						$keyword = "AND";
					}
					$sql = $sql.' '.$keyword.' '.$condition[$i];
				}
		}

		return $result = mysqli_query($conn, $sql);

	}

function selectNotice($conn, $all_selected_batches){
		$sql = "SELECT notices.title, notices.description, notices_types.bootstrap_class
				FROM notices
				JOIN notices_types ON notices_types.id = notices.notice_type_id
				WHERE notices.batch_id IN $all_selected_batches
				ORDER BY notices.id DESC";

		return $result = mysqli_query($conn, $sql);
	}

function selectBatch($conn){
		$sql = "SELECT batches.id, batches.code, batches.title, batches.class_limit
				FROM batches
				JOIN user_batch ON user_batch.batch_id = batches.id
				WHERE user_batch.user_id = ".$_SESSION['user']['id']."
				ORDER BY batches.id DESC";

		return $result = mysqli_query($conn, $sql);
	}


function selectAttendanceList($conn, $user_id, $get_data = null){
	if (empty($get_data)) {
		$sql = "SELECT attendances.id, attendances.user_id, attendances.date, attendances.rating, attendances.review, attendances.approved, batches.title
			FROM attendances
			JOIN batches ON attendances.batch_id = batches.id
			WHERE attendances.user_id = $user_id";
	}else{

		$sql = "SELECT attendances.id, attendances.user_id, attendances.date, attendances.rating, attendances.review, attendances.approved, batches.title
			FROM attendances
			JOIN batches ON attendances.batch_id = batches.id
			WHERE attendances.user_id = $user_id";

		if (array_key_exists('title', $get_data) && $get_data['title'] != '') {
					$condition[] = 'batches.title LIKE "%'.$get_data['title'].'%"';
				}
		if (array_key_exists('date', $get_data) && $get_data['date'] != '') {
					$condition[] = 'attendances.date LIKE "%'.$get_data['date'].'%"';
				}
		if (array_key_exists('review3', $get_data) && $get_data['review'] != '') {
					$condition[] = 'attendances.review LIKE "%'.$get_data['review'].'%"';
				}

				for ($i=0; $i < count($condition); $i++) { 
					if ($i == 0) {
						$keyword = "AND";
					}else{
						$keyword = "AND";
					}
					$sql = $sql.' '.$keyword.' '.$condition[$i];
				}
	}

	return $result = mysqli_query($conn, $sql);
}


function selectBatchForTrainer($conn, $trainer_id){
	$sql = "SELECT user_batch.user_id, user_batch.batch_id, batches.title 
			FROM `user_batch`
			JOIN batches ON user_batch.batch_id = batches.id
			WHERE batches.trainer_id = $trainer_id";
	return $result = mysqli_query($conn, $sql);
}

function pendingAttendances($conn, $all_batchs, $trainer_id){
	$sql = "SELECT attendances.id, attendances.user_id, attendances.date, attendances.rating, attendances.review, attendances.approved, batches.title, users.name
			FROM attendances
			LEFT JOIN batches ON attendances.batch_id = batches.id
			LEFT JOIN users ON attendances.user_id = users.id
			WHERE attendances.batch_id IN $all_batchs
			AND attendances.approved = 0
			AND attendances.user_id != $trainer_id";

	return $result = mysqli_query($conn, $sql);
}