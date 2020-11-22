<?php
    include 'connect.php';
    session_start();
    $sql = "SELECT * FROM `_limit_list` WHERE status = 1";
    $result = mysql_query($sql);
    $limitTable = array();
    while ($row = mysql_fetch_array($result)) {
        $limitTable[] = $row;
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
        justify-content: flex-start;
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
        width: 40%;
        background-color: #F2F8F9;
    }
    .content1{
        width: 50%;
        /*height: 750px;*/
        background-color: #F2F8F9;
        display: flex;
        flex-direction: column;
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
            <li role="presentation" class="active"><a href="manage_handle2.php">条件管理</a></li>
            <li role="presentation"><a href="manage_handle3.php">审核管理</a></li>
        </ul>
        <div class="content">
            <table class="table table-hover">
        <thead>
          <tr>
            <th>条件名</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $table = '';
            for($i = 0;$i<count($limitTable);$i++){
                $table .= '<tr>';
                for($j = 1;$j<3;$j++){
                    if($j == 2){
                        $table .= '<td><button type="button" class="btn btn-default btn-xs" onclick="option('.$limitTable[$i][0].')">修改</button>
                        <button type="button" class="btn btn-default btn-xs" onclick="del('.$limitTable[$i][0].')">删除</button>
                        </td>';
                    }else{
                        $table .= '<td>'.$limitTable[$i][$j].'</td>';
                    }
                }
                $table .= '</tr>';
            }
            echo $table;
        ?>
        </tbody>
</table>
        </div>
        <div class="content1">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">添加条件</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_limit" placeholder="输入条件名">
                </div>
                <label for="inputEmail3" class="col-sm-4 control-label" style="float:right;margin-top:10px;"><button type="button" class="btn btn-success" onclick="add_limit()">添加</button></label>
            </div>
            <div class="change_limit">
                
            </div>
        </div>
    </div>
<script type="text/javascript">
    function sign_out(){
        window.location.href = './index.html';
    }
    function option(id){
        $('.change_limit').load('limit_option.php',{id:id});
    }
    function del(e){
        if(window.confirm('确定删除吗？')){
            $.post("limit.mysql.php",{id:e,action:2},function(){
            alert('删除成功！');
            window.location.reload();
        })
        }
    }
    function add_limit(){
        var new_limit = document.getElementById('new_limit').value;
        if(new_limit){
            $.post("limit.mysql.php",{action:1,new_limit:new_limit},function(){
            alert('添加成功！');
            window.location.reload();
        })
        }else{
            alert('不能为空')
        }
        
    }
</script>
</body>
</html>
