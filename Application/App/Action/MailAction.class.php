<?php
namespace App\Action;
class MailAction extends CommonAction {
	/*
	 * 留言发邮件通知我 姓名 30 邮箱 30 主题 30 消息 200
	 */
    public function index() {
        if(empty($_POST ["email"]) || empty($_POST ["subject"]) ||  empty($_POST ["name"]) ||  empty($_POST ["message"])){
            echo json_encode ( array (
					"code" => 0,
					"msg" => "Invalid data"
			));
			exit ();
        }

		if ($_POST ["email"] == "zhang5474jj@163.com") {
			echo json_encode ( array (
					"code" => 0,
					"msg" => "Fuck you!<br/>",
					"msg2" => "ＳＢ!" 
			));
			exit();
		}
		import ( "ORG.Util.Phpmailer" );
		$mail = new PHPMailer (); // 建立邮件发送类
		$address = "zhang5474jj@163.com";
		$mail->IsSMTP (); // 使用SMTP方式发送
		$mail->CharSet='utf8';
		//$mail->IsHTML();
		$mail->Host = "smtp.163.com"; // 您的企业邮局域名
		$mail->SMTPAuth = true; // 启用SMTP验证功能
		$mail->Username = "zhang5474jj@163.com"; // 邮局用户名(请填写完整的email地址)
		$mail->Password = "zhangcheng123"; // 邮局密码
		$mail->Port = 25;
		$mail->From = "zhang5474jj@163.com"; // 邮件发送者email地址
		$mail->FromName = "zhang5474jj@163.com";
		$mail->AddAddress ( "1091796360@qq.com", "zc" ); // 收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
		// $mail->AddReplyTo("",// "");                                         
		// $mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
		// $mail->IsHTML(true); //
		// set email format to HTML
		// //是否使用HTML格式
		
		$mail->Subject = "www.vipzhangcheng.cn - ContactMe ： From User" . $_POST ["name"]; // 邮件标题
		$mail->Body = "发件人：" . $_POST ["name"] . "\n联系邮箱：" . $_POST ["email"] . "\n 主题：" . $_POST ["subject"] . "\n 消息：" . $_POST ["message"]; // 邮件内容
                                                                                                                // $mail->AltBody                                                                                                                
		// 时间限制 10m
		if (! isset ( $_SESSION ["mail"] ["send_time"] )) {
			$_SESSION ["mail"] ["send_time"] = time ();
		} else {
			if (time () - $_SESSION ["mail"] ["send_time"] < 600) {
				echo json_encode ( array (
						"code" => 0,
						"msg" => "留言太频繁，间隔需要10分钟",
						"msg2" => "" 
				) );
				exit ();
			}
		}
		
		if (! $mail->Send ()) {
			echo json_encode ( array (
					"code" => 0,
					"msg" => "发送失败",
					"msg2" => "" 
			) );
			exit ();
		} else {
			$_SESSION ["mail"] ["send_time"] = time ();

            $mail = new PHPMailer (); // 建立邮件发送类
		    $address = "zhang5474jj@163.com";
		    $mail->IsSMTP (); // 使用SMTP方式发送
		    $mail->Host = "smtp.163.com"; // 您的企业邮局域名
		    $mail->SMTPAuth = true; // 启用SMTP验证功能
		    $mail->Username = "zhang5474jj@163.com"; // 邮局用户名(请填写完整的email地址)
		    $mail->Password = "zhangcheng123"; // 邮局密码
		    $mail->Port = 25;
		    $mail->CharSet='utf8';
			// 发送给 留言人 通知接受到了
			$mail->From = "zhang5474jj@163.com"; // 邮件发送者email地址
			$mail->FromName = "www.vipzhangcheng.cn";
			$mail->AddAddress ( $_POST ["email"], $_POST ["name"] );
			
			$mail->Subject = "www.vipzhangcheng.cn - 收到了您的留言"; // 邮件标题
			$mail->Body = "www.vipzhangcheng.cn 收到了您的留言！此邮件为自动回复邮件！"; // 邮件内容
			$arr = array (
					"msg2" => "自动回复邮件已发送" 
			);
			if (! $mail->Send ()) {
				$arr = array (
						"msg2" => "未成功发送回复到您的邮箱" 
				);
			}
			echo json_encode ( array_merge ( $arr, array (
					"code" => 1,
					"msg" => "留言成功<br/>" 
			) ) );
		}
	}
}
