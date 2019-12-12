<?php
	include "common/global_config.php";
	session_start();
	session_destroy();

	goToError($base_url);

