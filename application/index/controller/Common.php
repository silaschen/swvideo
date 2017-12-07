<?php 
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use wechat\Wechat;
/**
* 
*/
class Common extends Controller
{
	
	#判断登录状态#
	protected function IsUser($js = false){
		if(Request::instance()->isAjax()){
			if(!session('uid') || !session('openid')) json('会话过期，请刷新页面重试!');
		}else{
          	$this->WxAuth($js);
          	$this->WxLogin(Cookie('WX_PROFILE'));
			// if(!session('uid') || !session('openid')) alert('会话过期，请刷新页面重试!');
		}
	}


	#用户信息保存#
	public function WxLogin($info){
		// if(session('uid')) return session('uid');
		$user = Db::name('user_list')->where(['openid'=>session('openid')])->find();
		$data = $info;
		unset($data['privilege']);
		$data['nickname'] = self::filterEmoji($data['nickname']);
		if($user){
			//更新
			 Db::name('user_list')->where(['openid'=>session('openid')])->update($data);
		 	session('uid',$user['id']);
		 }else{
		 	$data['addtime'] = time();
		 	$r = Db::name('user_list')->insert($data);
		 	session('uid',$r);
		 }
	}


	// 过滤掉emoji表情
	public static function filterEmoji($str)
	{
	 $str = preg_replace_callback(
	   '/./u',
	   function (array $match) {
	    return strlen($match[0]) >= 4 ? '' : $match[0];
	   },
	   $str);
	 
	  return $str;
	 }

	#授权模式获取微信用户信息#
	protected function WxAuth($js=false){
		$direct = Request::instance()->url(true); //当前访问URL
		$code = input('code');
		if(!$code && !session('openid')){
			header("Location:"."https://open.weixin.qq.com/connect/oauth2/authorize?appid=".Config('APPID')."&redirect_uri=".urlencode($direct)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
		}
      	//if(session('openid')) file_put_contents('step2.txt',$code.session('openid'));
		if(!session('openid') && $code){
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".Config('APPID')."&secret=".Config('APPSECRET')."&code=".$code."&grant_type=authorization_code";
			$r = json_decode(file_get_contents($url),true);
			if($r['openid'] && $r['access_token']){
				session('openid',$r['openid']); //openid
				$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$r['access_token']."&openid=".$r['openid']."&lang=zh_CN";
				$user = json_decode(file_get_contents($url),true);
				if($user['headimgurl'] || $user['nickname']){
					Cookie('WX_PROFILE',$user);
				}
			}
		}
		// if($js){
		// 	//SDK 
		// 	import("@.ORG.WeiXin");
		// 	$WeiXin = new WeiXin();
		// 	$res = $WeiXin->GetSignPackage();
		// 	$this->assign('SDK',$res);
		// }
	}

	#微信网页支付参数 (订单编号 金额 回调地址 名称 后缀)#
	protected function SetWxPay($no,$fee,$url,$body='商品名称',$attch=''){
        $WX = new Wechat();
	file_put_contents('b.txt',222);
        $payinfo = $WX->payconfig($no,$fee*100,$body,$attch,$url);
        $payjsapi = $WX->payjsapi($payinfo['prepay_id']);
        $this->assign('payjsapi',$payjsapi);
        return $payjsapi;
	}


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





}
 ?>
