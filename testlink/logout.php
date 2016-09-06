<?php

	/* Log out code for website web service */
	session_start();
	session_destroy();
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/api/testlink/login.php');
	exit;



?>