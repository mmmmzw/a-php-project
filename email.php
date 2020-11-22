
<?php
session_start();
$name = $_POST['name'];
$email = $_POST['email'];
// $name = $_POST['name'];
// $password = $_POST['password'];
// $sql = "UPDATE user set password='$password' where name='$name'";
// // echo $sql;

// $result = mysql_query($sql);
// if(!$result){
//      echo "0";
// }
// else{
//      echo "1";
// }

require_once("./PHPMailer.php"); 
require_once("./SMTP.php");
/*发送邮件方法
 *@param $to：接收者 $title：标题 $content：邮件内容
 *@return bool true:发送成功 false:发送失败
 */
 
use PHPMailer\PHPMailer;
function sendMail($to,$title,$content){
 
 
    //实例化PHPMailer核心类
    $mail = new PHPMailer\PHPMailer();
 
    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;
 
    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();
 
    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;
 
    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';
 
    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
 
    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;
 
    //设置smtp的helo消息头 这个可有可无 内容任意
    // $mail->Helo = 'Hello smtp.qq.com Server';
 
    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    $mail->Hostname = 'http://zhaozhXXXxg.cn';
 
    //设置发送的邮件的编码 可选GB2312  据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';
 
    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = 'Liang';
 
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='646873920@qq.com';
 
    //smtp登录的密码 使用生成的授权码
    $mail->Password = 'tzxlrpxdqykwbfai';
 
    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = '646873920@qq.com';
 
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true); 
 
    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to,'标题啦');
 
    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','l通知');
 
    //添加该邮件的主题
    $mail->Subject = $title;
 
    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;
 
    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./55.jpg','head.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Juery-1.1.0.js','jquery.js');
 
    $status = $mail->send();
 
    //简单的判断与提示信息
    if($status) {
        return true;
    }else{
        return false;
    }
}
 
$content = "ABCDEFGHIJKMNPQRSTUVWXYabcdefghijkmnpqrstuvwxy0123456789";
// echo $content."<br/>";
//4.1 创建一个变量存储产生的验证码数据，便于用户提交核对
$captcha = "";
for ($i = 0; $i < 4; $i++) {
    // 字体大小
    $fontsize = 10;
    // 字体颜色
    $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
    $captcha .= $fontcontent;
}
    // echo $captcha."<br/>";
$_SESSION["name"] = $captcha;

$flag = sendMail($email,'验证码-忘记密码',$captcha);
if($flag){
    echo "1";
}else{
    echo "0";
}
