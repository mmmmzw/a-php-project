<?php
	session_start();
	$name = $_POST['name'];
	$capture = $_POST['capture'];
	if($capture == $_SESSION["name"]){
		echo "0";
	}
	else{
		echo "1";
	}
?>