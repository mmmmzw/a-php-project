<?php
    include 'connect.php';
	session_start();
    $step = isset($_GET['step']) ? $_GET['step'] : '-2';
    $sql = "SELECT * FROM `user_apply` WHERE step = $step";
    $res = mysql_query($sql);
    $apply = array();
    while ($row = mysql_fetch_array($res)) {
        $apply[] = $row;
    }
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
            <li role="presentation"><a href="manage_handle1.php">项目管理</a></li>
            <li role="presentation"><a href="manage_handle2.php">条件管理</a></li>
            <li role="presentation" class="active"><a href="manage_handle3.php">审核管理</a></li>
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
                        <th>用户ID</th>
                        <th>项目ID</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    <tbody>
                        <?php
                            $table = '';
                            for ($i=0; $i < count($apply); $i++) {
                                $table .= '<tr>';
                               for ($j=0; $j < 5; $j++) { 
                                    if($j == 3){
                                        switch ($apply[$i][$j]) {
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
                                            case '3':
                                                $table .= '<td>已通过</td>';
                                                break;
                                            case '4':
                                                $table .= '<td>未通过</td>';
                                                break;
                                        }
                                    }else if($j == 4){
                                            $table .= '<td><button onclick=pass_check('.$apply[$i]['id'].')>查看详情</button></td>';
                                    }else{
                                        $table .= '<td>'.$apply[$i][$j].'</td>';
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
    </div>
<script src="./jquery-3.3.1.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function sign_out(){
		window.location.href = './index.html';
	}
    function pass_check(e){
       $(".content").load("check_apply.php",{id:e})
    }
</script>
</body>
</html>