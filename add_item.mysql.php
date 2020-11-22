<?php
	include 'connect.php';
	$id = $_POST['id'];
	$name = $_POST['name'];
	$content = $_POST['content'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$str_limit = $_POST['str_limit'];
	$action = $_POST['action'];
	if($action == 2){//修改项目信息
		$sql = "UPDATE item SET content = '$content', start = '$start',end = '$end',`limit` = '$str_limit' WHERE id = $id";
		mysql_query($sql);
	}else if($action == 3){
		$sql = "UPDATE item SET status = 0 WHERE id = $id";
		mysql_query($sql);
	}else{
		$sql ="INSERT INTO item VALUES(null,1,'$name','$content','$start','$end','$str_limit')";
		mysql_query($sql);
	}
?>