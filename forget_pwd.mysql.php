<?php
	include 'connect.php';
    session_start();
		$name = $_POST['name'];
		$password = $_POST['password'];
		$sql = "UPDATE user set password='$password' where name='$name'";
		// echo $sql;

		$result = mysql_query($sql);
		if(!$result){
			 echo "0";
		}
		else{
			 echo "1";
		}
?>