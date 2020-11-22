<?php
    include 'connect.php';
	session_start();
    $sql = "SELECT id,name,content,start,`end`,`limit` FROM `item` WHERE status = 1";
    $result = mysql_query($sql);
    $itemTable = array();
    while ($row = mysql_fetch_array($result)) {
        $itemTable[] = $row;
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
       /* height: 750px;*/
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
        <div class="content">
            <table class="table table-hover">
        <thead>
          <tr>
            <th>项目名</th>
            <th>内容</th>
            <th>起始日期</th>
            <th>截止日期</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $table = '';
            for($i = 0;$i<count($itemTable);$i++){
                $table .= '<tr>';
                for($j = 1;$j<6;$j++){
                    if($j == 5){
                        $table .= '<td><button type="button" class="btn btn-default btn-xs" onclick="option('.$itemTable[$i][0].')">查看详情</button></td>';
                    }else{
                        $table .= '<td>'.$itemTable[$i][$j].'</td>';
                    }
                }
                $table .= '</tr>';
            }
            echo $table;
        ?>
        </tbody>
</table>
        <button type="button" class="btn btn-success" onclick="add_item()">添加项目</button>
        </div>
    </div>
<script src="./jquery-3.3.1.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function sign_out(){
		window.location.href = './index.html';
	}
    function option(e){
      $('.content').load("item_option.php",{id:e});
    }
    function add_item(){
        window.location.href = './add_item.php';
    }
</script>
</body>
</html>