<?php 
	include 'connect.php';
	$id = $_POST['id'];
	$newStep = $_POST['newStep'];
	$reason = $_POST['reason'];
	$sql = "UPDATE user_apply SET step = '$newStep',reason = '$reason' WHERE id = $id";
	mysql_query($sql);
?>