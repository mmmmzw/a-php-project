<?php
	include 'connect.php';
	$id = $_POST['id'];
	$sql = "SELECT * FROM `user` WHERE id = $id";
	$result = mysql_query($sql);
	$user = mysql_fetch_row($result);
	$permisson = $user[3] == '1' ? '管理员' : '用户';
?>
<form class="form-horizontal" style="margin-top: 20px;">
  <div class="form-group" style="width: 100%;">
    <label for="inputEmail3" class="col-sm-2 control-label">用户id</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" value='<?php echo $user[0];?>' name='update' readonly>
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name='update' placeholder="用户名" value="<?php echo $user[1];?>" readonly>
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name='update' placeholder="密码" value="<?php echo $user[2];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">管理权限</label>
    <button type="button" class="btn btn-info" onclick="change_permission()">设置为管理员</button>
    <div class="col-sm-8">
      <input type="text" class="form-control" name='update' placeholder="管理权限" value="<?php echo $permisson;?>" readonly>
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">公司名称</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name='update' placeholder="公司名称" value="<?php echo $user[4];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">成立时间</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name='update' placeholder="成立时间" value="<?php echo $user[5];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">公司地址</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name='update' placeholder="公司地址" value="<?php echo $user[6];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">研发投入（单位：万）</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="研发投入（单位：万）" value="<?php echo $user[7];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">专利发明（单位：个）</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="专利发明（单位：个）" value="<?php echo $user[8];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">技术比例（单位：%）</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="技术比例（单位：%）" value="<?php echo $user[9];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">本科生人数</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="本科生人数" value="<?php echo $user[10];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">硕士生人数</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="硕士生人数" value="<?php echo $user[11];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">博士生人数</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="博士生人数" value="<?php echo $user[12];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">本科以下人数</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="本科以下人数" value="<?php echo $user[13];?>">
    </div>
  </div>
  <div class="form-group" style="width: 100%;">
    <label for="inputPassword3" class="col-sm-2 control-label">总人数</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name='update' placeholder="总人数" value="<?php echo $user[14];?>">
    </div>
  </div>
</form>
<button type="button" class="btn btn-default" style="margin:0 0 20px 20px;" onclick="back()">返回</button>
<button type="button" class="btn btn-danger" style="float:right;margin:0 60px 20px 0;" onclick="del()">删除用户</button>
<button type="button" class="btn btn-success" style="float:right;margin:0 20px 20px 0;" onclick="update()">保存修改</button>
<script type="text/javascript">
	var changes = document.getElementsByName('update');
	function back(){
		window.location.reload();
	}
	function change_permission(){
		$.post("update_user.mysql.php",{action:1,
			id:changes[0].value},function(){
				alert('设置成功！');
				window.location.reload();
			});
	}
	function update(){
		$.post("update_user.mysql.php",{
			id:changes[0].value,
			password:changes[2].value,
			company:changes[4].value,
			date:changes[5].value,
			location:changes[6].value,
			research:changes[7].value,
			patent:changes[8].value,
			technology:changes[9].value,
			undergraduate:changes[10].value,
			master:changes[11].value,
			doctor:changes[12].value,
			no_degree:changes[13].value,
			number:changes[14].value
		},function(){
			alert('设置成功！');
			window.location.reload();
		})
	}
	function del(){
			if(window.confirm('你确定要删除该用户吗？')){
                 $.post("update_user.mysql.php",{action:2,
			id:changes[0].value},function(){
				alert('删除成功！');
				window.location.reload();
			});
              }
	}
</script>