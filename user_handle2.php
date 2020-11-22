<?php
    include 'connect.php';
    session_start();
    $name = $_SESSION['name'];
    $sql = "SELECT * FROM user WHERE name = $name";
    $result = mysql_query($sql);
    $row = mysql_fetch_row($result);
    $_SESSION['id'] = $row[0];
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
            <li role="presentation" class="active"><a href="user_handle2.php">个人信息</a></li>
        </ul>
        <div class="content" style="text-align: center;">
            <form class="form-horizontal" style="margin-top: 20px;text-align: center;">
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">公司名称</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" readonly name="userInfo" value=<?php echo $row[4];?> >
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">成立时间</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" readonly name="userInfo" value=<?php echo $row[5];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">公司地址</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="userInfo" value=<?php echo $row[6];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">研发投入（单位：万）</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[7];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">专利发明（单位：个）</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[8];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">技术比例（单位：%）</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[9];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">本科生人数</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[10];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">硕士生人数</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[11];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">博士生人数</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[12];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">本科以下人数</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[13];?>>
                    </div>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label class="col-sm-2 control-label">总人数</label>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" name="userInfo" value=<?php echo $row[14];?>>
                    </div>
                </div>
            </form>
             <button class="btn btn-success" onclick="save_changes()">点击保存</button>
        </div>
    </div>
<script src="./jquery-3.3.1.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function sign_out(){
        window.location.href = './index.html';
    }
    function save_changes(){
        var info = document.getElementsByName('userInfo');
        var infoArr = [];
        for(var i=2;i<11;i++){
            infoArr.push(info[i].value);
        }
       $.post('change_user_info.mysql.php',{infoArr:infoArr},function(){
        alert('保存成功')
       })
    }
</script>
</body>
</html>