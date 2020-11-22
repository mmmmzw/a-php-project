<?php
	session_start();
	include 'connect.php';
	$sql = "SELECT * FROM `_limit_list` WHERE status = 1";
	$result = mysql_query($sql);
	$limit = array();
	while ($row = mysql_fetch_array($result)) {
		$limit[] = $row;
	}
	$sql1 = "SELECT name FROM `item` WHERE status = 1";
	$result1 = mysql_query($sql1);
	$item_name = array();
	while ($row = mysql_fetch_array($result1)) {
		$item_name[] = $row;
	}
	$name_json = json_encode($item_name);
	echo '<script>var item_name = '.$name_json.'</script>';
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <title>管理员</title>
    <style type="text/css">
    .left_nav{
        display: flex;
        flex-direction: row;
        /*height: 750px;*/
    }
    .left_nav ul{
        width: 10%;
        text-align: center;
        margin:0 auto 0 auto;
    }
    .top{
        width: 100%;
        height: 3vw;
        background-color:#D9EDF7;
        text-align: right;
        padding-right: 50px;
        line-height: 3vw;
    }
    .content{
        width: 90%;
        background-color: #F2F8F9;
    }
    </style>
</head>
<body>
    <div class="top">
        <span>你好，<?php echo $_SESSION['name'];?></span> <button class="btn btn-default btn-xs" onclick="sign_out()">退出登录</button>
    </div>
    <div class="left_nav">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="manage_handle0.php">用户管理</a></li>
            <li role="presentation" class="active"><a href="manage_handle1.php">项目管理</a></li>
            <li role="presentation"><a href="manage_handle2.php">条件管理</a></li>
            <li role="presentation"><a href="manage_handle3.php">审核管理</a></li>
        </ul>
        <div class="content" style="text-align: center;">
			<form class="form-horizontal" style="margin-top: 20px;">
  				<div class="form-group" style="width: 100%;">
    				<label class="col-sm-2 control-label">项目名称</label>
    				<div class="col-sm-8">
      				<input type="text" class="form-control" placeholder="项目名称" name="item" onchange="check_name()">
    				</div>
  				</div>
  				<div class="form-group" style="width: 100%;">
  					<label class="col-sm-2 control-label">项目内容</label>
  					<div class="col-sm-8">
    				<textarea class="form-control" rows="3" name="item"></textarea>
    				</div>
  				</div>
  				<div class="form-group" style="width: 100%;">
    				<label class="col-sm-2 control-label">起始日期</label>
    				<div class="col-sm-8">
      				<input type="date" class="form-control" placeholder="起始日期" value="2018-01-01" name="item">
    				</div>
  				</div>
  				<div class="form-group" style="width: 100%;">
    				<label class="col-sm-2 control-label">截止日期</label>
    				<div class="col-sm-8">
      				<input type="date" class="form-control" placeholder="截止日期" value="2018-01-01" name="item">
    				</div>
  				</div>
  				<h4>以下是申请项目所需要的条件（默认为0）</h4>
  				<?php
  					foreach ($limit as $value) {
  						echo '<div class="form-group" style="width: 100%;">
    				<label class="col-sm-2 control-label">'.$value[1].'</label>
    				<div class="col-sm-8">
      				<input type="number" class="form-control" placeholder='.$value[1].' onchange="limit_list('.$value[0].',\''.$value[1].'\')" id=limit'.$value[0].'>
    				</div>
  				</div>';
  					}
  				?>
			</form>
			<button class="btn btn-success" onclick="add()" style="margin-bottom: 20px;">完成添加</button>
        </div>
    </div>
<script src="./jquery-3.3.1.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var item = document.getElementsByName('item');
	var limit = [];
	function check_name(){
		var name = item[0].value;
		for(var i=0;i<item_name.length;i++){
			if(name == item_name[i].name){
				alert('项目名称重复');
				item[0].style.borderColor = 'red';
				break;
			}else{
				item[0].style.borderColor = '';
				continue;
			}
		}
	}
	function sign_out(){
		window.location.href = './index.html';
	}
	function add(){
		var name = item[0].value;
		var content = item[1].value;
		var start = item[2].value;
		var end = item[3].value;
		var str_limit = limit.join('');
		$.post("add_item.mysql.php",{
			name:name,
			content:content,
			start:start,
			end:end,
			str_limit:str_limit
		},function(){
			alert('添加成功');
			window.location.reload();
		})
	}
	function limit_list(e,n){
		var val = document.getElementById('limit'+e).value;
		if(val){
			//limit[e] = '"'+e+'"'+"=>"+val+",";
			limit[e] = e+"=>"+val+",";
		}else{
			limit.splice(e,1,'');
		}
	}
</script>
</body>
</html>