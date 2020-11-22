<?php
	session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <title>用户</title>
    <style type="text/css">
    .left_nav{
        display: flex;
        flex-direction: row;
        height: 750px;
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
            <li role="presentation"><a href="user_handle0.php">项目申请</a></li>
            <li role="presentation"><a href="user_handle1.php">项目管理</a></li>
            <li role="presentation"><a href="user_handle2.php">个人信息</a></li>
        </ul>
        <div class="content">
        </div>
    </div>
<script src="./jquery-3.3.1.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function sign_out(){
		window.location.href = './index.html';
	}
</script>
</body>
</html>