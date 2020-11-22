<?php
	include 'connect.php';
    session_start();
    $id = $_SESSION['id'];
    $infoArr = $_POST['infoArr'];
    $sql = "UPDATE user SET location = '$infoArr[0]',research = '$infoArr[1]',patent = '$infoArr[2]',technology = '$infoArr[3]',undergraduate = '$infoArr[4]',master = '$infoArr[5]',doctor = '$infoArr[6]',no_degree = '$infoArr[7]',number = '$infoArr[8]' WHERE id = $id";
    mysql_query($sql);
?>