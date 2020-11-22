<?php
	include 'connect.php';
	$id = $_POST['id'];
	$sql = "SELECT * FROM `item` WHERE status = 1 AND id = $id";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
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
	echo "<script>var content = \"$row[3]\"</script>";
	echo "<script>var json_limit = $json_item_limit</script>";
	echo "<script>var limit_arr = ".$limit_arr."</script>";
?>
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
    	<textarea class="form-control" rows="3" id="item_content" name="item"></textarea>
    	</div>
  	</div>
  	<div class="form-group" style="width: 100%;">
    	<label class="col-sm-2 control-label">起始日期</label>
    	<div class="col-sm-8">
      	<input type="date" class="form-control" value=<?php echo $row[4];?> name="item">
    	</div>
  	</div>
  	<div class="form-group" style="width: 100%;">
    	<label class="col-sm-2 control-label">截止日期</label>
    	<div class="col-sm-8">
      	<input type="date" class="form-control" value=<?php echo $row[5];?> name="item">
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
 <button class="btn btn-warning" style="margin-bottom: 20px;margin-right:20px;float: right;" onclick="del_item()">删除</button>
 <button class="btn btn-success" onclick="update_item()" style="margin-bottom: 20px;margin-right:20px;float: right;">完成修改</button>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#item_content')[0].innerText = content;
 		for(var i=0;i<json_limit.length-1;i++){
 			$('#limit'+json_limit[i][0]).val(json_limit[i][1]);
 		}

 	})
 	function limit_list(){
 		var limit = [];
		for(var i=0;i<limit_arr.length;i++){
			var index = limit_arr[i].id;
			var value = $('#limit'+index).val();
			if(value){
				limit[index] = index+"=>"+value+",";
			}
		}
		return limit;
	}
	function update_item(){
		var detail = document.getElementsByName('item');
		var id = detail[0].value;
		var content = detail[1].value;
		var start = detail[2].value;
		var end = detail[3].value;
		var limit = limit_list();
		var str_limit = limit.join('');
		$.post('add_item.mysql.php',{
			id:id,
			content:content,
			start:start,
			end:end,
			str_limit:str_limit,
			action:2
		},function(data){
			alert('修改成功');
			window.location.reload();
		})
	}
	function del_item(){
		var detail = document.getElementsByName('item');
		var id = detail[0].value;
		if(confirm('确定要删除吗？')){
			$.post('add_item.mysql.php',{id:id,action:3},function(){
				alert('删除成功');
				window.location.reload();
			})
		}
	
	}
 </script>