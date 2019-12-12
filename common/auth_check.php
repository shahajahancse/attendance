<?php
	if(!isset($_SESSION['user']) || $_SESSION['user'] == ""){
		goToError($base_url);
	}