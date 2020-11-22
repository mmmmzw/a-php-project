<?php
include "connect.php";
$id = $_POST['id'];
$sql = "SELECT * FROM `user_apply` WHERE id = $id";
$res = mysql_query($sql);
$apply = mysql_fetch_array($res);
$step = '';
$style = 'style="display: none"';
switch ($apply['step']) {
	case '-2':
		$step = '待上报';
		break;
	case '-1':
		$step = '待审核';
		$style = '';
		break;
	case '1':
		$step = '已上报';
		break;
	case '2':
		$step = '待评审';
		$style = '';
		break;
	case '3':
		$step = '已通过';
		break;
	case '4':
		$step = '未通过';
		break;
}
?>
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">项目ID</label>
    <input type="text" class="form-control" value="<?php echo $apply['item_id']?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">用户ID</label>
    <input type="text" class="form-control" value="<?php echo $apply['user_id']?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">状态</label>
    <input type="text" class="form-control" value="<?php echo $step?>" readonly>
  </div>
  <div class="form-group" <?php echo $style;?>>
    <label for="exampleInputPassword1" >理由</label>
    <input type="text" class="form-control" id="reason">
  </div>
  <button type="submit" class="btn btn-default" onclick="window.location.reload()">返回</button>
  <button type="submit" class="btn btn-success" onclick="subReason(1)" <?php echo $style;?>>通过</button>
  <button type="submit" class="btn btn-warning" onclick="subReason(0)" <?php echo $style;?>>未通过</button>
</form>
<script type="text/javascript">
	function subReason(e){
		step = "<?php echo $apply['step'];?>";
		id = "<?php echo $id;?>";
		reason = document.getElementById('reason').value;
		if(e == 1){
			newStep = step == '-1' ? '2' : '3';
			$.post("check_apply_mysql.php",{id:id,newStep:newStep,reason:reason})
		}else{
			newStep = step == '-1' ? '-2' : '4';
			$.post("check_apply_mysql.php",{id:id,newStep:newStep,reason:reason})
		}
	}
</script>