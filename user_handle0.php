<?php
    include 'connect.php';
	session_start();
    $outData = $_GET['outData'];
    $name = $_SESSION['name'];
    $sql1 = "SELECT * FROM user WHERE name = $name";
    $res = mysql_query($sql1);
    $userInfo1 = mysql_fetch_array($res);
    $_SESSION['id'] = $userInfo1[0];
    $sql = "SELECT id,name,start,end,`limit` FROM `item` WHERE status = 1 and id NOT IN (SELECT item_id FROM user_apply WHERE user_id = $userInfo1[0])";
    $result = mysql_query($sql);
    $item = array();
    while ($row = mysql_fetch_array($result)) {
        $item[] = $row;
    }
    $company_date = substr($userInfo1[6],0,4);
    $nY = date("Y");
    $duration = $nY-$company_date;
    if($duration == 0){
        $userInfo1[6] = 1;
    }else{
        $userInfo1[6] = $duration;//用户扩展信息
    }
    $now = strtotime('now');
    $start = strtotime($item[0][2]);
    echo "<script>var outData = \"$outData\"</script>";
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <title>用户</title>
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
        <span>你好，<?php echo $name;?></span> <button class="btn btn-default btn-xs" onclick="sign_out()">退出登录</button>
    </div>
    <div class="left_nav">
        <ul class="nav nav-pills nav-stacked">
            <div class="btn-group" style="width: 100%;">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;padding-top: 9px;padding-bottom: 9px;">项目申请<span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="?outData=-1">未过期项目</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="?outData=1">已过期项目</a></li>
                </ul>
            </div>
            <li role="presentation"><a href="user_handle1.php">项目管理</a></li>
            <li role="presentation"><a href="user_handle2.php">个人信息</a></li>
        </ul>
        <div class="content">
            <em><strong>注：红色框为过期项目</strong></em><br>
            <em><strong>注：黄色框为未过期但不可申请项目</strong></em><br>
            <em><strong>注：绿色框为未过期且可申请项目</strong></em>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>项目ID</th>
                        <th>项目名称</th>
                        <th>起始日期</th>
                        <th>截止日期</th>
                        <th>操作</th>
                    </tr>
                    <tbody>
                        <?php
                            $table = '';
                            for ($i=0; $i < count($item); $i++) {
                                $start = strtotime($item[$i][2]); 
                                $end = strtotime($item[$i][3]);
                                $ind = '';
                                if($now < $end && $now > $start){
                                    $limit1 = explode(",",$item[$i][4]);
                                    $limit2 = array();
                                    foreach ($limit1 as $value) {
                                        $limit2[] = explode("=>",$value);
                                    }
                                    foreach ($limit2 as $value) {
                                        $ind .= $value[1] > $userInfo1[$value[0]+5] ? $value[0].'0' : '';
                                    }
                                    if($ind){
                                        $table .= '<tr class="warning">';
                                    }else{
                                        $table .= '<tr class="success">';
                                    }
                                }else{
                                    $table .= '<tr class="danger">';
                                }
                               for ($j=0; $j < 5; $j++) { 
                                    if($j == 4){
                                        $table .= '<td><button class="btn btn-default btn-xs" onclick=detail('.$item[$i][0].','.$ind.')>查看详情</button></td>';
                                    }else{
                                        $table .= '<td>'.$item[$i][$j].'</td>';
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
    $('document').ready(function(){
        if(outData == -1){
            $('.danger').css('display','none');
        }else if(outData == 1){
            $('.warning').css('display','none');
            $('.success').css('display','none');
        }else{}
    })
	function sign_out(){
		window.location.href = './index.html';
	}
    function detail(id,ind){
       $('.content').load('item_detail.php',{id:id,ind:ind})
    }
</script>
</body>
</html>