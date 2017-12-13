<?php 
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
* 公共类
*/
class Common extends Controller
{
	
	#上传#
	public function upload(){

			$file = request()->file('files');

			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info){
			// 成功上传后 获取上传信息
			// 输出 jpg
			$infos = $info->getSaveName(); 
			// 输出 42a79759f284b767dfcb2a0197904287.jpg
			$path = 'public'.DS.'uploads/'.$infos;
			exit(json_encode(['file'=>$path,'ret'=>1]));
			}else{
			// 上传失败获取错误信息
	
			exit(json_encode(['msg'=> $file->getError()]));

		}

	}


	/**
	*send mail
	*/
	public function sendmail($user,$subject,$body){

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = '434684326@qq.com';                 // SMTP username
		    $mail->Password = 'tcgvwzmwmqbdcaii';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to
		    //Recipients
		    $mail->setFrom('434684326@qq.com', 'SWvideo Team');


		    $mail->addAddress($user);     // Add a recipient
		    // $mail->addAddress('ellen@example.com');               // Name is optional
		    // $mail->addReplyTo('info@example.com', 'Information');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    // //Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $body;
		    $mail->AltBody = $body;
		    $mail->send();
		    return true;
		} catch (Exception $e) {
		    return ['msg'=>$mail->ErrorInfo];
		}
	}





}
 ?>
