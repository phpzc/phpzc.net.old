<?php
use App\Common\Language;



if(is_ssl()){
	define("NET_NAME","https://" . $_SERVER ["HTTP_HOST"] );
}else{
	define("NET_NAME","http://" . $_SERVER ["HTTP_HOST"] );
}

define('ACTION_SUCCESS',1);
define('ACTION_ERROR',0);

/**
 * 取得语言对象
 *
 * @return Language|null
 */
function Lang()
{
	static $lan = null;
	if($lan == null){
		$lan = new Language();
		if(session('language') == null){
			session('language','zh');
		}
		$lan->setLanguage(session('language'));
		$lan->load();
	}
	return $lan;
}



function percent_func($all,$view)
{
	if($view ==0){
		echo 0;
		return;
	}

	$n = $view /$all;
	if($n > 1){
		echo 100;
	}else if($n < 0.02){
		echo 1;
	}else{
		$n *= 100;
		$n = (int)($n);
		$n %= 100;

		echo $n;
	}

}

function replace_str($source)
{
	$str = str_replace("http://www.vipmhxy.com", NET_NAME, $source);
	$str = str_replace("http://www.localhost.com", NET_NAME, $str);

	return $str;
	 
}

/**
   *  截取指定的中英文字符的长度code支持utf-8 和gb2312 两种格式
   */
  function cut_str($string, $sublen, $start = 0, $code = 'utf-8'){

    if($code == 'utf-8'){

            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";

            preg_match_all($pa, $string, $t_string);
            if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";

                return join('', array_slice($t_string[0], $start, $sublen));

    }else{
                $start = $start*2;
                $sublen = $sublen*2;
                $strlen = strlen($string);
                $tmpstr = '';
                for($i=0; $i< $strlen; $i++){
                    if($i>=$start && $i< ($start+$sublen)){
                        if(ord(substr($string, $i, 1))>129){
                            $tmpstr.= substr($string, $i, 2);
                        }else{
                            $tmpstr.= substr($string, $i, 1);
                        }
                     }
                    if(ord(substr($string, $i, 1))>129)
                    $i++;
                }   
                //超出多余的字段就显示...
            if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
            return $tmpstr;
     }

   }

function findImageUrl($content)
{
	$preg = "/\<img src=\"(.*?)\"/";
	$arr= array();
	preg_match($preg,htmlspecialchars_decode($content),$arr);
	if(count($arr) >0)
	{
		return $arr[1];
	}else{
		//return "/Public/img/default_img1.jpg";	
		//return "<img src='/Public/img/background/logo.gif' style='margin:auto;'/>";
		return "";
	}
	
}
   
   
function sstrlen($str,$charset) {         
        $n = 0; $p = 0; $c = ''; 
        $len = strlen($str); 
        if(strtolower($charset) == 'utf-8') { 
            for($i = 0; $i < $len; $i++) { 
                $c = ord($str{$i}); 
                if($c > 252) { 
                    $p = 5; 
                } elseif($c > 248) { 
                    $p = 4; 
                } elseif($c > 240) { 
                    $p = 3; 
                } elseif($c > 224) { 
                    $p = 2; 
                } elseif($c > 192) { 
                    $p = 1; 
                } else { 
                    $p = 0; 
                } 
               // echo $p.'<br/>';
                $i+=$p;
                $n++; 
                //计算第一个字符是什么 然后判断一个字 占几个字符 
            } 
        } else {
           // gbk计算方式  2个字符算1个长度 
            for($i = 0; $i < $len; $i++) { 
                $c = ord($str{$i}); 
                if($c > 127) { 
                    $p = 1; 
                } else { 
                    $p = 0; 
                } 
                $i+=$p;$n++; 
            } 
        }         
        return $n; 
    } 


//截图函数
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale,$quality=90){
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	$source = imagecreatefromjpeg($image);
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$thumb_image_name,$quality);
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}

function getword($str,$charset='utf-8') {         
        $n = 0; $p = 0; $c = ''; 
        $len = strlen($str); 
        $arr= array();
        if(strtolower($charset) == 'utf-8') { 
            
            for($i = 0; $i < $len; $i++) { 
                $c = ord($str{$i}); 
                if($c > 252) { 
                    $p = 5; 
                } elseif($c > 248) { 
                    $p = 4; 
                } elseif($c > 240) { 
                    $p = 3;  
                } elseif($c > 224) { 
                    $p = 2; 
                } elseif($c > 192) { 
                    $p = 1; 
                } else { 
                    $p = 0; 
                }
                $arr[] = substr($str,$i,$p+1);
                $i += $p;
                $n++; 
            }
        } else {
           // gbk计算方式  2个字符算1个长度 
            for($i = 0; $i < $len; $i++) { 
                $c = ord($str{$i}); 
                if($c > 127) { 
                    $p = 1; 
                } else { 
                    $p = 0; 
                }
                $arr[] = substr($str,$i,$p+1); 
                $i += $p;
                $n++;
                
            }       
        }

        $result = array('length'=>$n,'word'=>$arr);
        return $result; 
                     
}
function getLength($str)
{
	$arr = getword($str);
	return $arr['length'];
}
/*根据bpath获取分类名称*/
function getCategoryName($path)
{
	$arr = explode("-",$path);
	$res = NULL;
	foreach($_SESSION["website"]["category"] as $k=>$v){
		
		if($v["id"] == $arr[1]){
			$res = $v["name"];
			break;
		}
	}
	return $res;
}

/*根据bpath获取分类css*/
function getCategoryClassName($path)
{
	$name = strtolower(getCategoryName($path));
	if ($name == "c++"){
		$name = "cpp";
	}
			
		
	return 'c_'.$name;
}

/*根据category id 获取名字*/
function getCategoryNameById($id)
{
	$res = "";
	foreach($_SESSION["website"]["category"] as $k=>$v){

		if($v["id"] == $id){
			$res = $v["name"];
			break;
		}
	}
	return $res;
}

/*根据tag id 获取名字*/
function getTagNameById($tag)
{
	$res = "";
	foreach($_SESSION["website"]["tag"] as $k=>$v){
	
		if($v["id"] == $tag){
			$res = $v["name"];
			break;
		}
	}
	return $res;
}


/*根据bpath 获取顶级分类id*/
function getCategoryId($path)
{
	$arr = explode("-",$path);
	return $arr[1];
}

//资料 文件格式图片
function getDocumentTypeImage($type)
{
	$img = "";
	switch($type)
	{
		case 1:
			break;
		case 2:
			break;
		case 3:
			break;
		case 4:
			break;
		case 5:
			break;
	}
	return $img;
}
//资料 存储网盘类型图片
function getDocumentStoreTypeImage($type)
{
	$img = "";
	switch($type)
	{
		case 1:
			
			break;
		case 2:
			
			break;
		case 3:
			
			break;
			
	}
	return $img;
}


/**
 * json返回函数统一调用
 * @param data 返回结果数组 
 * @param errorCode 成功还是失败码 0成功 1失败
 * @return void
 */
function jsonPrint($data,$errorCode)
{
	if ($errorCode == 0){
		jsonSuccess($data);
	} else{
		jsonError($data);
	}	
}
/**
 * json返回函数统一调用
 * @param data 如果errorCode为1 自动追加为error_str 否则视为 array
 * @param errorCode 成功还是失败码 0成功 1失败
 * @return void
 */
function jsonP($data,$errorCode)
{
	if ($errorCode == 0){
		jsonSuccess($data);
	} else{
		jsonError(array("error_str"=>$data));
	}
}

function jsonSuccess($data)
{
	$arr = array(
		"success"=>1,
		"error_str"=>"",
	);
	$arr = array_merge($arr,$data);
	echo json_encode($arr,true);
	exit();
}
function jsonError($data)
{
	$arr = array(
		"success"=>0,
		"error_str"=>$data['error_str'],
	);
	$arr = array_merge($arr,$data);
	echo json_encode($arr,true);
	//dump($arr);
	exit();
}

function encodeId($id) {
	$mid = md5 ( $id );
	$str = substr ( $mid, 0, 16 );
	$str .= $id;
	$str .= substr ( $mid, 16, 16 );
	return $str;
}

function base_encode($url)
{
	$url = base64_encode($url);

	$url = strtr($url,'+/=','-!_');

	return $url;
}
function base_decode($url)
{

	$url = strtr($url,'-!_','+/=');

	$url = base64_decode($url);
	
	return $url;
}

function send_email($toAddress,$toName,$subject='',$body='')
{
	//import ( "ORG.Util.PHPMailer" );
	include_once LIB_PATH.'Org/Util/Phpmailer.class.php';
    $mail = new PHPMailer (); // 建立邮件发送类
	$address = C("EMAIL_USER");
	$mail->IsSMTP (); // 使用SMTP方式发送
	$mail->CharSet='utf8';
	//$mail->IsHTML();
	$mail->Host = C('EMAIL_HOST'); // 您的企业邮局域名
	$mail->SMTPAuth = true; // 启用SMTP验证功能
	$mail->Username = C("EMAIL_USER"); // 邮局用户名(请填写完整的email地址)
	$mail->Password = C("EMAIL_PWD"); // 邮局密码
	$mail->Port = C('EMAIL_PORT');
	$mail->From = C("EMAIL_USER"); // 邮件发送者email地址
	$mail->FromName = C("EMAIL_USERNAME");
	$mail->AddAddress ( $toAddress, $toName ); // 收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")

	$mail->IsHTML(true);


	$mail->Subject = $subject; // 邮件标题
	$mail->Body = $body; // 邮件内容
	
	return $mail->Send();
}
