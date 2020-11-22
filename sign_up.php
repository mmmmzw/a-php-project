<?php
	include './connect.php';
	$sql = "SELECT name,password FROM `user`";
	$result = mysql_query($sql);
	$userInfo = array();
	while ($row = mysql_fetch_array($result)) {
		$userInfo[] = $row;
	}
	$json = json_encode($userInfo);
	echo "<script>var userInfo = $json</script>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>注册</title>
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="./css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
		input{
			margin-top: 20px;
		}
	</style>
</head>
<body>
	<div class="container" style="text-align: right;">
    	<input type="text" class="form-control" name='userInput' placeholder="账号(必填)" onchange='checkInput(0)'>
    	<input type="password" class="form-control" name='userInput' placeholder="密码(必填)">
    	<input type="text" class="form-control" name='userInput' placeholder="公司(必填)">
    	<input type="text" class="form-control" name='userInput' placeholder="地址(必填)">
    	<div class="input-group">
    	<input type="text" class="form_date" readonly data-date-format="yyyy-mm-dd" name='userInput' placeholder="成立时间(必填)">
    	<input type="number" class="form-control" name='userInput' placeholder="研发投入(选填) 单位:万" onchange='checkInput(5)'>
    	<input type="number" class="form-control" name='userInput' placeholder="专利发明(选填) 单位:个" onchange='checkInput(6)'>
    	<input type="number" class="form-control" name='userInput' min="0" max="100" placeholder="技术比例(选填) 单位:%" onchange='checkInput(7)'>
    	</div>
    	<div class="input-group">
    		<input type="number" class="form-control" name='userInput' placeholder="本科生数量(选填)" onchange='checkInput(8)'>
    		<input type="number" class="form-control" name='userInput' placeholder="硕士数量(选填)" onchange='checkInput(9)'>
    		<input type="number" class="form-control" name='userInput' placeholder="博士数量(选填)" onchange='checkInput(10)'>
    		<input type="number" class="form-control" name='userInput' placeholder="本科以下(选填)" onchange='checkInput(11)'>
    		<input type="number" class="form-control" name='userInput' placeholder="总人数(必填)" onchange='checkInput(12)'>
    	</div>
    	<button type="button" class="btn btn-success" style="margin-top: 20px;" onclick="sign_up()">注册</button>
   </div>
<script type="text/javascript" src="./jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="./js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
	var userInput = document.getElementsByName('userInput');
		//日期控件
	$('.form_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
		function checkInput(e){
			if(e == 0){
				for(var i=0;i<userInfo.length;i++){
					if(userInput[0].value == userInfo[i].name){
						userInput[0].style.borderColor = 'red';
						alert('该账号已被注册！')
						break;
					}else{
						userInput[0].style.borderColor = '';
						continue;
					}
				}
			}
		}
		function sign_up(){
			var new_user = [];
			for(var i=0;i<userInput.length;i++){
				new_user[i] = userInput[i].value;
			}
			if(new_user[0] && new_user[1] && new_user[2] && new_user[3] && new_user[4] && new_user[12]){
				$.post('sign_up.mysql.php',{new_user:new_user},function(){
				alert('注册成功！');
				window.location.href = './index.html';
			})
			}else{
				alert('必填项没填完！');
			}
			
		}
</script>
</body>
</html>