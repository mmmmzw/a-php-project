<?php
		echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
		echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
		echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
		
		// 判断当期目录下的 upload 目录是否存在该文件
		// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
		if (file_exists("upload/" . $_FILES["file"]["name"]))
		{
			echo $_FILES["file"]["name"] . " 文件已经存在。 ";
		}
		else
		{	
			$name=iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
			// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $name);
			echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
		}
?>