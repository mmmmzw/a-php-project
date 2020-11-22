<?php
	include 'connect.php';
	session_start();
	$id = $_POST['id'];
	$ind = isset($_POST['ind']) ? explode('0',$_POST['ind']) : '';
	$sql = "SELECT * FROM `item` WHERE status = 1 AND id = $id";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$now = strtotime('now');
	$start = strtotime($row[4]);
	$end = strtotime($row[5]);
	$sql1 = "SELECT * FROM `_limit_list` WHERE status = 1";
	$result1 = mysql_query($sql1);
	$limit = array();
	while ($row1 = mysql_fetch_array($result1)) {
		$limit[] = $row1;
	}
	$item_limit = explode(',',$row[6]);
	$item_limit1 = array();
	foreach($item_limit as $value){
		$item_limit1[] = explode('=>',$value);
	}
	$json_item_limit = json_encode($item_limit1);
	$limit_arr = json_encode($limit);
	$json_ind = json_encode($ind);
	echo "<script>var content = \"$row[3]\"</script>";
	echo "<script>var json_limit = $json_item_limit</script>";
	echo "<script>var limit_arr = ".$limit_arr."</script>";
	echo "<script>var ind = $json_ind</script>";
?>
 <em><strong>注：黄色框为条件未满足</strong></em><br>
<form class="form-horizontal" style="margin-top: 20px;text-align: center;">
  	<div class="form-group" style="width: 100%;">
    	<label class="col-sm-2 control-label">项目ID</label>
    	<div class="col-sm-8">
      	<input type="text" class="form-control" placeholder="项目ID" name="item" readonly value=<?php echo $row[0];?>>
    	</div>
  	</div>
  	<div class="form-group" style="width: 100%;">
  		<label class="col-sm-2 control-label">项目名称</label>
  		<div class="col-sm-8">
    	<input type="text" class="form-control" placeholder="项目名称" readonly value=<?php echo $row[2];?>>
    	</div>
  	</div>
  	<div class="form-group" style="width: 100%;">
  		<label class="col-sm-2 control-label">项目内容</label>
  		<div class="col-sm-8">
    	<textarea class="form-control" rows="3" readonly id="item_content" name="item"></textarea>
    	</div>
  	</div>
  	<div class="form-group" style="width: 100%;">
    	<label class="col-sm-2 control-label">起始日期</label>
    	<div class="col-sm-8">
      	<input type="date" class="form-control" readonly value=<?php echo $row[4];?> name="item">
    	</div>
  	</div>
  	<div class="form-group" style="width: 100%;">
    	<label class="col-sm-2 control-label">截止日期</label>
    	<div class="col-sm-8">
      	<input type="date" class="form-control" readonly value=<?php echo $row[5];?> name="item">
    	</div>
  	</div>
  	<h4>以下是申请项目所需要的条件（默认为0）</h4>
  				<?php
  					foreach ($limit as $value) {
  						echo '<div class="form-group" style="width: 100%;">
    				<label class="col-sm-2 control-label">'.$value[1].'</label>
    				<div class="col-sm-8">
      				<input type="number" class="form-control" readonly placeholder='.$value[1].' onchange="limit_list('.$value[0].',\''.$value[1].'\')" id=limit'.$value[0].'>
    				</div>
  				</div>';
  					}
  				?>
  				<button type="button" class="btn btn-default" style="margin-bottom: 20px;" onclick="back()">返回</button>
  				<?php
  					if (!$ind && $now >= $start && $now < $end) {
  							echo '<button type="button" class="btn btn-success" style="margin-bottom: 20px;" onclick=apply('.$_SESSION['name'].','.$id.')>申请</button>';
  					}
  				?>
 </form>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#item_content')[0].innerText = content;
 		for(var i=0;i<json_limit.length-1;i++){
 			$('#limit'+json_limit[i][0]).val(json_limit[i][1]);
 		}
 		for(var i=0;i<ind.length-1;i++){
 			$('#limit'+ind[i]).css('background-color','orange');
 		}
 	})
 	function back(){
 		window.location.reload();
 	}
 	function apply(uN,iI){
 		$('.content').load('user_apply.php',{user_name:uN,item_id:iI});
 	}
 </script>