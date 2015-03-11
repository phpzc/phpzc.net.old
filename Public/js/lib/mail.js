VIP.namespace("Email");

VIP.Email = {
		contactMe:function(){
			var name = $("#contact1").val();
			var mail = $("#contact2").val();
			var subject = $("#contact3").val();
			var message = $("#contact4").val();
			VIPLog(name);
			VIPLog(mail);
			VIPLog(subject);
			VIPLog(message);
			//内容检测
			if ( name.indexOf("Your Name") == 0)
			{
				return;
			}
			if (mail.indexOf("Your Email") == 0)
			{
				return;
			}
			if (subject.indexOf("Subject")==0)
			{
				return;
			}
			if(message.indexOf("Your Message here....") == 0)
			{
				return;
			}
			//长度检测
			if( !VIP.Form.checkLength(name,30))
			{
				VIP.MessageBox.createBoxAuto("姓名长度不能超过30");
				return;
			}
			var isMail = VIP.Form.email(mail);
			//alert(isMail);
			//return;
			if(!isMail)
			{
				VIP.MessageBox.createBoxAuto("邮箱格式不正确");
				return;
			}
			
			if( !VIP.Form.checkLength(mail,30))
			{
				VIP.MessageBox.createBoxAuto("邮箱长度不能超过30");
				return;
			}
			if( !VIP.Form.checkLength(subject,30))
			{
				VIP.MessageBox.createBoxAuto("主题长度不能超过30");
				return;
			}
			if( !VIP.Form.checkLength(message,200))
			{
				VIP.MessageBox.createBoxAuto("留言长度不能超过30");
				return;
			}	
			$.ajax({
                type:"POST",
                url:VIP.Base()+"/mail/index",
                data:"email="+mail+"&subject="+subject+"&name="+name+"&message="+message,
                async:true,
                dataType:"json",
                success: function(msg)
                {
                		var str = msg.msg + msg.msg2;
                		
                		VIP.MessageBox.createBoxAuto(str);
                }
			});
		},
};