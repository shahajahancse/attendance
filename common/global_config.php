<?php
	
	$base_url = "http://localhost/attendance";

	$db_host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_name = "attendance_db";

	function goToError($url){
		// $url = $base_url."/common/403.php";
    	echo "<script> location.href='".$url."'; </script>";
	}

?>