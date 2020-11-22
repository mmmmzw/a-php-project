<?php
	include 'connect.php';
	session_start();
	$user_id = $_SESSION['id'];
	$item_id = $_POST['item_id'];
	$apply_id = $_POST['apply_id'];
	$action = $_POST['action'];
	if($action == 'changeStep'){
		$sql = "UPDATE `user_apply` SET step = '-1' WHERE id = $apply_id";
		mysql_query($sql);
	}else if($action == 'pass_check'){
		$sql = "UPDATE `user_apply` SET step = '1' WHERE id = $apply_id";
		mysql_query($sql);
	}else{
		$sql = "INSERT INTO `user_apply` VALUES(null,'$user_id','$item_id','$action',null)";
		mysql_query($sql);
	}
?>