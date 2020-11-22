<?php
	include 'connect.php';
	session_start();
	$user_id = $_SESSION['id'];
	$item_id = $_POST['item_id'];
	$sql1 = "SELECT * FROM `item` WHERE id = $item_id";
	$res1 = mysql_query($sql1);
	$item = mysql_fetch_array($res1);
	$sql2 = "SELECT * FROM `user` WHERE id = $user_id";
	$res2 = mysql_query($sql2);
	$user = mysql_fetch_array($res2);
	echo "<script>var item_id = \"$item[0]\"</script>";
?>
<h1>申请单</h1>
<h3>项目表</h3>
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">项目名称</label>
    <input type="text" class="form-control" value="<?php echo $item[2]?>" readonly>
  </div>
</form>
<h3>企业表</h3>
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">企业名称</label>
    <input type="text" class="form-control" value="<?php echo $user[4]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">企业地址</label>
    <input type="text" class="form-control" value="<?php echo $user[5]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">成立时间</label>
    <input type="date" class="form-control" value="<?php echo $user[6]?>" readonly>
  </div>
</form>
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputEmail2">研发投入</label>
    <input type="number" class="form-control" value="<?php echo $user[7]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">专利发明</label>
    <input type="number" class="form-control" value="<?php echo $user[8]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">技术比例</label>
    <input type="number" class="form-control" value="<?php echo $user[9]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">本科生人数</label>
    <input type="number" class="form-control" value="<?php echo $user[10]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">硕士生人数</label>
    <input type="number" class="form-control" value="<?php echo $user[11]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">博士生人数</label>
    <input type="number" class="form-control" value="<?php echo $user[12]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">本科以下人数</label>
    <input type="number" class="form-control" value="<?php echo $user[13]?>" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">总人数</label>
    <input type="number" class="form-control" value="<?php echo $user[14]?>" readonly>
  </div>
</form>
<form method="post" action="#" enctype="multipart/form-data" id="uploadForm" target="tg">
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" name="file">
    <button type="submit" class="btn btn-default" onclick="file_info()">上传</button>
  </div>
</form>
<iframe name="tg" id="tg" style="display: none;"></iframe>
<button type="button" class="btn btn-success btn-lg" onclick="save()">保存</button>
<script src="./jquery-3.3.1.min.js"></script>
<script src="./jquery.form.js"></script>
<script type="text/javascript">
	function file_info(){
		$('#uploadForm').ajaxSubmit({
			type: 'post',
			url: 'upload_file.php', 
            success: function(data) { // data 保存提交后返回的数据，一般为 json 数据
                alert('上传成功')
            }
        });
	}
	function save(){
		$.post("user_apply.mysql.php",{item_id:item_id,action:-2},function(){
			window.location.reload();
		})
	}
</script>