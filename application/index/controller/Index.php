<?php
namespace app\index\controller;
use think\Db;
include EXTEND_PATH."qiniu/autoload.php";
use Qiniu\Auth;
use app\index\controller\Common;
class Index extends Common
{
    public function index(){
    	$list = Db::name('tag')->order('see desc,count desc')->limit(10)->select();
    	$style = [
    	"color:red;","color:pink","color:yellow;","color:green","color:blue","color:purple","color:#454545"
    	];
    	$this->assign('style',$style);
    	$this->assign('list',$list);

        $video = Db::name('video')->where(['status'=>1])->order('views desc,addtime desc')->limit(9)->select();
        for ($i=0; $i < count($video); $i++) { 
            $video[$i]['cover'] = $this->thumb($video[$i]['key']);
        }

        $this->assign('videolist',$video);

         $video18 = Db::name('video')->where(['status'=>1])->order('addtime desc')->limit(9)->select();
        for ($i=0; $i < count($video18); $i++) { 
            $video18[$i]['cover'] = $this->thumb($video18[$i]['key']);
        }


       

        $this->assign('videolist18',$video18);

   		return $this->fetch('index',['title'=>'SwVideo']);
    }

    /**
     * taglist
     */
    public function taglist(){
    	$this->title= "tag list";
    	$list = Db::name('tag')->order('see desc,count desc')->select();
    	$style = [
    	"color:red;","color:pink","color:yellow;","color:green","color:blue","color:purple","color:#454545"
    	];
    	$this->assign('style',$style);
    	$this->assign('list',$list);
    	return $this->fetch('taglist',['title'=>'Tags']);
    }

    /**
     * video list
     */
    public function videolist(){
    	$p = input('p') ? input('p'):1;
    	$tag = input('tag');
		if($tag){
			$tagid = Db::name('tag')->where(['tag'=>$tag])->value('id');
			$videoid = Db::name('video_tag')->where(['tagid'=>$tagid])->select();
			$video = array_column($videoid, 'videoid');
			$map['id'] = array('in',$video);
		}   
		$map['status'] = 1;
		$model = Db::name('video');
		$list = $model
		->where($map)->paginate(6,false,['query' => request()->param()])->toArray();
        for ($i=0; $i < count($list['data']); $i++) { 
             //get the thumb for video
                $list['data'][$i]['cover'] = $this->thumb($list['data'][$i]['key']);
        }	


		// 获取分页显示
		$page = $model
        ->where($map)->paginate(6,false,['query' => request()->param()])->render();

		// 模板变量赋值
		$this->assign('list', $list);
		$this->assign('page', $page);
		return $this->fetch('videolist',['title'=>$tag?$tag:"videolist"]);
    }

    public function play(){
    	$id = input('id');
    	$video = Db::name('video')->where(array('id'=>$id))->find();
        $video['url'] = $this->MakeUrl($video['key'],60*10);
        $video['cover'] = $this->thumb($video['key']);
        $video['detail'] = $this->detail($video['key']);


        $tags = Db::name('video_tag')->where(array('videoid'=>$id))->select();
        $tagarr = array_column($tags, 'tagid');
        // 启动事务
        Db::startTrans();
        try{
            //update video views
            Db::name('video')->where(array('id'=>$id))->setInc('views',1);
            Db::name('tag')->where(array('id'=>['in',$tagarr]))->setInc('see',1);
            // 提交事务
            Db::commit();    
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
    	$tagvideo = Db::name('tag')->where(array('id'=>['in',array_column($tags, 'tagid')]))->select();
    	$this->assign('tags',$tagvideo);
    	$this->assign('video',$video);

        $videoarr = Db::name('video_tag')->where(['tagid'=>['in',$tagarr]])->select();
        $relation = Db::name("video")->where(['status'=>1,'id'=>['in',array_column($videoarr, 'videoid')]])->select();
        foreach ($relation as $key => $value) {
            $relation[$key]['cover'] = $this->thumb($value['key']);
        }
        $this->assign('list',$relation);
        $this->assign('title',$video['title']);
    	return $this->fetch('play');
    }


    private function MakeUrl($key,$time){
        $accessKey ="mjX2MSYCMedaxEWcbawLeroF3PxTtw6TAz-KEtgd";
        $secretKey = "6_z9j-xvludVNPrfMtlEv2YsRrOtnWe8m9TKxsu1";
        // 构建Auth对象
        $auth = new Auth($accessKey, $secretKey);
        // 私有空间中的外链 http://<domain>/<file_key>
        $baseUrl = 'http://p0ffo13yi.bkt.clouddn.com/'.$key;
        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl,$time);
        return $signedUrl;
    }

    private function thumb($key){
        $accessKey ="mjX2MSYCMedaxEWcbawLeroF3PxTtw6TAz-KEtgd";
        $secretKey = "6_z9j-xvludVNPrfMtlEv2YsRrOtnWe8m9TKxsu1";
        // 构建Auth对象
        $auth = new Auth($accessKey, $secretKey);
        // 私有空间中的外链 http://<domain>/<file_key>
        $baseUrl = 'http://p0ffo13yi.bkt.clouddn.com/'.$key."?vframe/png/offset/35/w/700/h/480";
        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl);
        return $signedUrl;

    }


    private function detail($key){
        $accessKey ="mjX2MSYCMedaxEWcbawLeroF3PxTtw6TAz-KEtgd";
        $secretKey = "6_z9j-xvludVNPrfMtlEv2YsRrOtnWe8m9TKxsu1";
        // 构建Auth对象
        $auth = new Auth($accessKey, $secretKey);
        // 私有空间中的外链 http://<domain>/<file_key>
        $baseUrl = 'http://p0ffo13yi.bkt.clouddn.com/'.$key."?avinfo";
        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl);
        $detail = file_get_contents($signedUrl);
        $res = json_decode($detail,true);
        return $res['format'];

    }

    public function law(){
        return $this->fetch('law',['title'=>'law']);
    }

    public function sendm(){
        $body = "please click the link below to finish check"."\n"."http://www.liondog.cn";
        var_dump($this->sendmail('chensiwei1@outlook.com','CHECK account',$body));
    }

    //register
    public function register(){
        if(\think\Request::instance()->isAjax()){
            $data = \think\Request::instance()->post();
            $ret = $this->registerweb($data['nickname'],$data['password'],$data['mail']);
            if($ret){
                exit(json_encode(['code'=>1]));
            }
        }
    }


    private function registerweb($nickname,$password,$mail){
         $user = Db::name('users')->where(['name'=>$nickname])->find();
         if($user) exit(json_encode(['error'=>'nickname exists']));
         $user1 = Db::name('users')->where(['mail'=>$mail])->find();
           if($user1) exit(json_encode(['error'=>'mail exists']));
        $ret = Db::name('users')->insertGetId(['name'=>$nickname,'password'=>md5($password),'mail'=>$mail,'status'=>0,'logintime'=>time()]);
        if($ret){
            $link = "http://www.liondog.cn/index/index/verify?id=".$ret."&mail=".$mail;
            $body = "welcome to register swvideo and we hope our site may make you feel fine."."\n"."please click the link below to finish checking"."<br>"."<a href='{$link}'>".$link."</a>";
            $this->sendmail($mail,"Check account for SWvideo",$body);
            return true;
        }else{
            return false;
        }
    }


    public function verify(){
        $id = input('id');
        $mail = input('mail');
        $user = Db::name('users')->where(['id'=>$id,'mail'=>$mail])->find();
        if($user){
            Db::name('users')->where(['id'=>$id])->setField('status',1);
            exit("U check ur account successfully!!!NOw to login!");
        }else{
            exit("user does not exists");
        }

    }




}
