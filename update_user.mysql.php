<?php
	include 'connect.php';
	$action = $_POST['action'];
	$id = $_POST['id'];
	$password = $_POST['password'];
	$company = $_POST['company'];
	$date = $_POST['date'];
	$location = $_POST['location'];
	$research = $_POST['research'];
	$patent = $_POST['patent'];
	$technology = $_POST['technology'];
	$undergraduate = $_POST['undergraduate'];
	$master = $_POST['master'];
	$doctor = $_POST['doctor'];
	$no_degree = $_POST['no_degree'];
	$number = $_POST['number'];
	if($action == '1'){
		$sql = "UPDATE user SET permission = 1 WHERE id = $id";
		mysql_query($sql);
	}else if($action == '2'){
		$sql = "DELETE FROM user WHERE id = $id";
		mysql_query($sql);
	}else{
		$sql = "UPDATE user SET password = '$password',company = '$company',date = '$date',location = '$location',research = '$research',patent = '$patent',technology = '$technology',undergraduate = '$undergraduate',master = '$master',doctor = '$doctor',no_degree = '$no_degree',number = '$number' WHERE id = $id";
		mysql_query($sql);
	}
?>