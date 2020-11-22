<?php
	include 'connect.php';
	$id = $_POST['id'];
	$action = $_POST['action'];
	$new_limit = $_POST['new_limit'];
	switch ($action) {
		case 2:
			$sql = "UPDATE _limit_list SET status = 0 WHERE id = $id";
			mysql_query($sql);
			break;
		case 1:
			$sql = "INSERT INTO _limit_list VALUES (null,'$new_limit',1)";
			mysql_query($sql);
			break;
		default:
			$sql = "UPDATE _limit_list SET _limit = '$new_limit' WHERE id = $id";
			mysql_query($sql);
	}
?>