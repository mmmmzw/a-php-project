<?php 
	include 'connect.php';
	$new_user = $_POST['new_user'];
	$sql = "INSERT INTO `user` VALUES (NULL, '{$new_user[0]}', '{$new_user[1]}', '0', '{$new_user[2]}', '{$new_user[4]}', '{$new_user[3]}', '{$new_user[5]}', '{$new_user[6]}', '{$new_user[7]}', '{$new_user[8]}', '{$new_user[9]}', '{$new_user[10]}', '{$new_user[11]}', '{$new_user[12]}')";
	mysql_query($sql);
?>