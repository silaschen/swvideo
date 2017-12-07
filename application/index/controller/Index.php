<?php
namespace app\index\controller;
use think\Db;
include EXTEND_PATH."qiniu/autoload.php";
use Qiniu\Auth;
class Index extends \think\Controller
{
    public function index(){
    	$list = Db::name('tag')->order('see desc,count desc')->limit(10)->select();
    	$style = [
    	"color:red;","color:pink","color:yellow;","color:green","color:blue","color:purple","color:#454545"
    	];
    	$this->assign('style',$style);
    	$this->assign('list',$list);
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
		->where($map)->paginate(9)->toArray();
        for ($i=0; $i < count($list['data']); $i++) { 
             //get the thumb for video
                $list['data'][$i]['cover'] = $this->thumb($list['data'][$i]['key']);
        }	


		// 获取分页显示
		$page = $model
        ->where($map)->paginate(9)->render();
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
        $baseUrl = 'http://p0ffo13yi.bkt.clouddn.com/'.$key."?vframe/png/offset/13/w/700/h/480";
        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl);
        return $signedUrl;

    }

    public function law(){
        return $this->fetch('law',['title'=>'law']);
    }

}
