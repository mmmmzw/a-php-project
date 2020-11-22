<?php
	include 'connect.php';
	$id = $_POST['id'];
	$sql = "SELECT * FROM `_limit_list` WHERE id = $id";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
?>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">修改条件</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id='nl' value=<?php echo $row[1]?>>
    </div>
    <label for="inputEmail3" class="col-sm-4 control-label" style="float:right;margin-top:10px;">
    <button type="button" class="btn btn-success" onclick="change_limit(<?php echo $id;?>)">完成</button></label>
</div>
<script type="text/javascript">
	function change_limit(e){
		var new_limit = document.getElementById('nl').value;
		$.post("limit.mysql.php",{id:e,new_limit:new_limit},function(){
			alert('修改成功！');
			window.location.reload();
		})
	}
</script>