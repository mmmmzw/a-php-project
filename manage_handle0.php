<?php
    include 'connect.php';
    session_start();
    $sql = "SELECT id,name,permission,company,date,location,research,patent,technology,undergraduate,master,doctor,no_degree,number FROM `user`";
    $result = mysql_query($sql);
    $userTable = array();
    while ($row = mysql_fetch_array($result)) {
        $userTable[] = $row;
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <script src="./jquery-3.3.1.min.js"></script>
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
            <li role="presentation" class="active"><a href="manage_handle0.php">用户管理</a></li>
            <li role="presentation"><a href="manage_handle1.php">项目管理</a></li>
            <li role="presentation"><a href="manage_handle2.php">条件管理</a></li>
            <li role="presentation"><a href="manage_handle3.php">审核管理</a></li>
        </ul>
        <div class="content">
            <table class="table table-hover">
        <thead>
          <tr>
            <th>用户名</th>
            <th>管理权限</th>
            <th>公司名字</th>
            <th>成立时间</th>
            <th>公司地址</th>
            <th>研究投入</th>
            <th>发明专利</th>
            <th>技术比例</th>
            <th>本科生</th>
            <th>硕士生</th>
            <th>博士生</th>
            <th>本科以下</th>
            <th>总人数</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $table = '';
            for($i = 0;$i<count($userTable);$i++){
                $table .= '<tr>';
                for($j = 1;$j<15;$j++){
                    if($j == 14){
                        $table .= '<td><button type="button" class="btn btn-default btn-xs" onclick="option('.$userTable[$i][0].')">设置</button></td>';
                    }else if($j == 2){
                        $permission = $userTable[$i][$j] == '1' ? '管理员' : '用户';
                        $table .= '<td>'.$permission.'</td>';
                    }else{
                        $table .= '<td>'.$userTable[$i][$j].'</td>';
                    }
                }
                $table .= '</tr>';
            }
            echo $table;
        ?>
        </tbody>
</table>
        </div>
    </div>
<script type="text/javascript">
    function sign_out(){
        window.location.href = './index.html';
    }
    function option(e){
        $('.content').load('./user_option.php',{id:e});
    }
</script>
</body>
</html>
