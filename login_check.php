<?php
	include 'connect.php';

	session_start();
	$name = $_POST['name'];
	$password = $_POST['password'];
	$captcha = $_POST["captcha"];

	//2. 将session中的验证码和用户提交的验证码进行核对,当成功时提示验证码正确，并销毁之前的session值,不成功则重新提交
	if(strtolower($_SESSION["captcha"]) != strtolower($captcha)){
			echo "2";
			$_SESSION["captcha"] = "";
			exit;
	}
	$sql = "SELECT permission FROM `user`WHERE name = '$name' AND password = '$password';";
	// permission
	// $result2 = mysql_fetch_assoc(mysql_query($sql)); //执行baisql语句并以关联数du组保存
	// echo "res2-----(";
	// echo $result2;
	// echo ")-----";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$_SESSION['name'] = $name;
	echo $row[0];
?>