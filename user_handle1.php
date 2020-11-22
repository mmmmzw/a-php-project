<?php
    include 'connect.php';
	session_start();
    $step = isset($_GET['step']) ? $_GET['step'] : '-2';
    $name = $_SESSION['name'];
    $sql1 = "SELECT * FROM user WHERE name = $name";
    $res1 = mysql_query($sql1);
    $user = mysql_fetch_array($res1);
    $user_id = $user['id'];
    $sql2 = "SELECT * FROM user_apply WHERE user_id = $user_id AND step = $step";
    $res2 = mysql_query($sql2);
    $user_apply = array();
    while ($row = mysql_fetch_array($res2)) {
        $user_apply[] = $row;
    }
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
            <li role="presentation" class="active"><a href="user_handle1.php">项目管理</a></li>
            <li role="presentation"><a href="user_handle2.php">个人信息</a></li>
        </ul>
        <div class="content">
            <div class="progress">
  <div class="progress-bar" style="width: 16%">
    <a href="?step=-2" style="color:white">待上报</a>
  </div>
  <div class="progress-bar progress-bar-warning" style="width: 16%">
    <a href="?step=-1" style="color:white">待审核</a>
  </div>
  <div class="progress-bar progress-bar-info" style="width: 16%">
    <a href="?step=1" style="color:white">已上报</a>
  </div>
  <div class="progress-bar" style="width: 16%">
    <a href="?step=2" style="color:white">待评审</a>
  </div>
  <div class="progress-bar progress-bar-success" style="width:16%">
    <a href="?step=3" style="color:white">已通过</a>
  </div>
  <div class="progress-bar progress-bar-danger" style="width: 16%">
    <a href="?step=4" style="color:white">未通过</a>
  </div>
</div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>申请单ID</th>
                        <th>项目ID</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    <tbody>
                        <?php
                            $table = '';
                            for($i = 0;$i < count($user_apply);$i++){
                                $table .= '<tr>';
                                for($j = 0;$j < 4;$j++){
                                    if($j == 2){
                                        switch ($user_apply[$i]["step"]) {
                                            case '-2':
                                                $table .= '<td>待上报</td>';
                                                break;
                                            case '-1':
                                                $table .= '<td>待审核</td>';
                                                break;
                                            case '1':
                                                $table .= '<td>已上报</td>';
                                                break;
                                            case '2':
                                                $table .= '<td>评审中</td>';
                                                break;
                                            default:
                                                $table .= '<td>已通过</td>';
                                                break;
                                        }
                                    }else if($j == 3){
                                        if($user_apply[$i]["step"] == '-2'){
                                            $table .= '<td><button onclick=changeStep('.$user_apply[$i]["id"].')>点击上报</button></td>';
                                        }else{
                                            $table .= '<td>无操作</td>';
                                        }
                                    }else if($j == 0){
                                        $table .= '<td>'.$user_apply[$i]["id"].'</td>';
                                    }else{
                                        $table .= '<td>'.$user_apply[$i]["item_id"].'</td>';
                                    }
                                }
                                $table .= '</tr>';
                            }
                            echo $table;
                        ?>
                    </tbody>
                </thead>
            </table>
        </div>
<script src="./jquery-3.3.1.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function sign_out(){
		window.location.href = './index.html';
	}
    function changeStep(id){
        $.post('user_apply.mysql.php',{apply_id:id,action:'changeStep'},function(){
            window.location.reload();
        })
    }
</script>
</body>
</html>