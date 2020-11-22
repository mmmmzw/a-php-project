<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>忘记密码</title>
	<meta name="description" content="Flat UI Kit Free is a Twitter Bootstrap Framework design and Theme, this responsive framework includes a PSD and HTML version."/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
	 <!-- Loading Bootstrap -->
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">
    <link href="docs/assets/css/demo.css" rel="stylesheet">
		<link rel="shortcut icon" href="dist/favicon.ico">
	<script type="text/javascript" src="./jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		let checked_capture = 0;	
			/*var password = user_input.value;*/
		function reset_pwd(){
			let user_input = document.getElementsByClassName('form-control login-field');
			var name = user_input[0].value;
			var password = user_input[3].value;
			if(checked_capture == 1 ){
				$.post('forget_pwd.mysql.php',{name:name,password:password},function(e){
					switch(e){
						case '0':
							alert('修改失败')
						break;
						case '1':
							alert('修改成功')
							window.location.href = "./index.html"
						break;
						default:
							alert('其他错误');
					}
				})	
			}
			else {
				alert("请填写并校验验证码！");
			}
			
		}
		function get_capture(){
			let user_input = document.getElementsByClassName('form-control login-field');
			var name = user_input[0].value;
			var email = user_input[1].value;
			$.post('email.php',{name:name,email:email},function(e){
					// switch(e){
					// 	case '0':
					// 		alert('发送失败')
					// 	break;
					// 	case '1':
					// 		alert('发送成功')
					// 	break;
					// 	default:
					// 		alert('其他错误');
					// }
					alert('发送成功')
			})	
		}
		function check_capture(){
			let user_input = document.getElementsByClassName('form-control login-field');
			var name = user_input[0].value;
			var capture = user_input[2].value;
			$.post('check_email_capture.php',{name:name,capture:capture},function(e){
					switch(e){
						case '0':
							alert('验证码正确')
							checked_capture = 1
						break;
						case '1':
							alert('验证码错误')
						break;
						default:
							alert('其他错误');
					}
			})	
		}
	</script>
</head>
<body>
<div class="container">
	<div class="login">
        <div class="login-screen">
          <div class="login-icon">
            <img src="docs/assets/images/login/icon.png" alt="Welcome to Mail App" />
            <h4>Welcome to <small>MY App</small></h4>
          </div>

          <div class="login-form">
            <div class="form-group">
              <input type="text" class="form-control login-field" value="" placeholder="用户名" id="login-name" />
              <label class="login-field-icon fui-user" for="login-name"></label>
						</div>
						<!-- //获取验证码 -->
						<div class="form-group" style="width:60%;float:left;">
              <input type="text" class="form-control login-field" value="" placeholder="请输入你的邮箱" id="capture" />
              <label class="login-field-icon fui-user" for="login-name"></label>
						</div>
						<a class="btn btn-primary btn-lg btn-block" href="#" style="width:30%;float:left;height:42px;font-size:10;" onclick="get_capture()">验证码</a>
						<br/><br/>
						<!-- 校验验证码 -->
						<div class="form-group" style="width:60%;float:left;">
              <input type="text" class="form-control login-field" value="" placeholder="请输入验证码" id="check_capture" />
              <label class="login-field-icon fui-user" for="login-name"></label>
						</div>
						<a class="btn btn-primary btn-lg btn-block" href="#" style="width:30%;float:left;height:42px;font-size:10;" onclick="check_capture()">检查</a>
						<br/><br/>


            <div class="form-group">
              <input type="password" class="form-control login-field" value="" placeholder="新密码" id="login-pass" />
              <label class="login-field-icon fui-lock" for="login-pass"></label>
						</div>
						

						<a class="btn btn-primary btn-lg btn-block" href="#" onclick="reset_pwd()">修改密码</a>

          </div>
        </div>
      </div>
</div>
</body>
</html>