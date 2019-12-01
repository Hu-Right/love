<?php

namespace app\index\controller;

use app\common\controller\IndexBase;
use think\Cache;
use think\Controller;
use think\Db;
use\think\Request;

class Show extends IndexBase
{
    public function index(){
    	$list = Db::name('article')->where('cid',7)->order('sort desc,id desc')->paginate(9);
    	$this->assign('list', $list);
        return $this->fetch();
    }

    public function make(){
    	$str = $_SERVER["QUERY_STRING"];
      	$area = cut_str($str,'/',-1);	
        
        Db::name('article')->where('id',$area)->setInc('reading');

        $x =  intval($area) -1;
       
        $xia = Db::name('article')->where('id',$x)->find();
        if (empty($xia)) {
            $xia['start'] = 0;
        }else{
            $xia['start'] = 1;
        }

        $s = intval($area) +1;
        $shang = Db::name('article')->where('id',$s)->find();
        if (empty($shang)) {
            $shang['start'] = 0;
        }else{
            $shang['start'] = 1;
        }

        $music = Db::name('music')->order('id desc')->limit('5')->select();

        $list = Db::name('article')->where('cid',7)->order('id')->paginate(8);
        $this->assign('shang',$shang);
        $this->assign('xia',$xia);
        $this->assign('list',$list);
        $this->assign('music',$music);
		return $this->fetch($area);      	
    }

    public function apimusic(){
        $like = input('param.name');
        $list = Db::name('music')->where("title",'like',"%{$like}%")->limit(8)->select();
        if (empty($list)) {
            $list[0]['url'] = '#';
            $list[0]['title'] = '找不到！';
        }
        return ['msg' => $list];
    }


    public function add(){
        $data = input('post.');

        $shu['title'] = $data['title'];
        $shu['tid'] = $data['type'];
        $shu['times'] = time();

       
        if (array_key_exists('boy',$data)) {
            $shu['manuser'] =$data['boy']; //表白对象男
        }
        if (array_key_exists('girl',$data)) {
            $shu['wouser'] =$data['girl']; //表白对象男
        }
        if (array_key_exists('mp3',$data)) {
            $shu['url'] =$data['mp3']; //音乐
        }
        if (array_key_exists('cont1',$data)) {
            $shu['pro1'] =$data['cont1']; //内容1
        }
        if (array_key_exists('cont2',$data)) {
            $shu['pro2'] =$data['cont2']; //内容2
        }
        if (array_key_exists('cont3',$data)) {
            $shu['pro3'] =$data['cont3']; //内容3
        }
        if (array_key_exists('cont4',$data)) {
            $shu['pro4'] =$data['cont4']; //内容4
        }
        if (array_key_exists('cont11',$data)) {
            $shu['pro5'] =$data['cont11']; //内容2
        }
        if (array_key_exists('cont6',$data)) {
            $shu['pro6'] =$data['cont6']; //内容2
        }
        if (array_key_exists('cont7',$data)) {
            $shu['pro7'] =$data['cont7']; //内容2
        }
        if (array_key_exists('cont8',$data)) {
            $shu['pro8'] =$data['cont8']; //内容2
        }
        if (array_key_exists('cont9',$data)) {
            $shu['pro9'] =$data['cont9']; //内容2
        }
        if (array_key_exists('cont10',$data)) {
            $shu['pro10'] =$data['cont10']; //内容2
        }
        if (array_key_exists('cont5',$data)) {
            $shu['time'] =$data['cont5']; //内容2
        }
        if (array_key_exists('img1',$data)) {
            $shu['img1'] =$data['img1']; //内容2
        }
        if (array_key_exists('img2',$data)) {
            $shu['img2'] =$data['img2']; //内容2
        }
        if (array_key_exists('img3',$data)) {
            $shu['img3'] =$data['img3']; //内容2
        }
        if (array_key_exists('img4',$data)) {
            $shu['img4'] =$data['img4']; //内容2
        }
        if (array_key_exists('img5',$data)) {
            $shu['img5'] =$data['img5']; //内容2
        }
        if (array_key_exists('img6',$data)) {
            $shu['img6'] =$data['img6']; //内容2
        }

        $list = DB::name('biaobai')->insertGetId($shu);

        $this->assign('url',$_SERVER['SERVER_NAME']);
        $this->assign('list',$list);
        return $this->fetch();
    }


    public function makelist(){
        $str = $_SERVER["QUERY_STRING"];
    
        $area = cut_str($str,'/',-1);   

        $list = Db::name('biaobai')->where('id',$area)->find();
        //dump($list);
        $this->assign('list',$list);
        return $this->fetch($list['tid'].'ls');
    }


    public function look(){
        $str  = $_SERVER["QUERY_STRING"];
      
        //$area = cut_str($str,'/',-1)
        $area = Request::instance()->get('look'); // 获取某个get变量;   
        dump($area);
        die;
		if ($area == 23) {
		   $list =[
		        'title' =>'翻页相册',
		        'img1' =>'/public/static/url/23/images/1.jpg',
		        'img2' =>'/public/static/url/23/images/2.jpg',
		        'img3' =>'/public/static/url/23/images/3.jpg',
		        'img4' =>'/public/static/url/23/images/4.jpg',
		        'img5' =>'/public/static/url/23/images/5.jpg',
		        'img6' =>'/public/static/url/23/images/6.jpg',
		        'pro1' =>'我们的相遇是意外的，但这是一个美丽幸福的意外，让我遇到了这么好的你',
		   ];
		}


        if ($area == 19) {
           $list =[
                'title' =>'头像',
                'url' =>''
           ];
        }

        if ($area == 18) {
           $list =[
                'title' =>'照片墙',
                'img1' =>'/public/static/url/18/img/c.png',
                'manuser' =>'赵璐思',
                'pro1' =>'ID:女朋友',
                'pro2' =>'性别：女',
                'img2' =>'/public/static/url/18/img/a.png',
                'url' =>''
           ];
        }

        if ($area == 17) {
           $list =[
                'title' =>'LOVE',
                'img1' =>'images/1.jpg',
                'manuser' =>'好',
                'wouser' =>'不好',
                'pro1' =>'我观察你很久了',
                'pro2' =>'小姐姐做我对象好不好',
                'pro3' =>'我就知道你会同意，爱你。',
                'pro4' =>'小姐姐在考虑一下呗~嘿嘿',
                'pro5' =>'你是我见过的最漂亮善良可爱的女孩',
                'pro6' =>'一生一世爱你',
                'pro7' =>'家务我全干',
                'pro8' =>'不藏私房钱',
                'pro9' =>'房子写你名',
                'pro10' =>'工资全上交',
                'img1' =>'/public/static/url/18/img/a.png',
                'url' =>''
           ];
        }

        if ($area == 16) {
            $list = [
                'title' => '每日一句2.0',
                'times' => time(),
                'manuser' => '周故',
                'wouser' =>'陈雪',
                'img1' =>'/public/static/url/16/picture/156490549968016.jpg'
            ];
        }

        if ($area == 15) {
            $list = [
                'title' => '每日一句2.0',
                'time' => '2019-10-4',
                'manuser' => '周故',
                'wouser' =>'陈雪',
                'times' =>time(),
                'img1' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img2' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img3' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img4' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img5' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img6' =>'/public/static/url/16/picture/156490549968016.jpg',
                'pro1' =>'我们的相遇是意外的，但这是一个美丽幸福的意外，让我遇到了这么好的你',
                'pro2' =>'莎士比亚说过：爱情是一种甜蜜的痛苦，但是我愿意忍受这种痛苦，莎士比亚还说过，世界上没有比服侍爱情更快乐的了，你愿不愿意享受这种快乐？当然你是愿意的~嘿嘿',
                'pro3' =>'之前我不相信一见钟情，但是见到你的那一刻，我否定了我的看法。我的心为你沦陷，从此只为你跳动',
                'pro4' =>'有一种爱的感觉，叫感同身受。有一种爱的默契，叫心有灵犀。有一种爱的承诺，叫天长地久'
            ];
        }

        if ($area == 14) {
            $list = [
                'title' => '我们的爱情',
                'time' => '2019-10-4',
                'manuser' => '我叫你的名字',
                'wouser' =>'我叫她的名字',
                'times' =>time(),
                'img1' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img2' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img3' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img4' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img5' =>'/public/static/url/16/picture/156490549968016.jpg',
                'img6' =>'/public/static/url/16/picture/156490549968016.jpg',
                'pro1' =>'我们的相遇是意外的，但这是一个美丽幸福的意外，让我遇到了这么好的你',
                'pro2' =>'莎士比亚说过：爱情是一种甜蜜的痛苦，但是我愿意忍受这种痛苦，莎士比亚还说过，世界上没有比服侍爱情更快乐的了，你愿不愿意享受这种快乐？当然你是愿意的~嘿嘿',
                'pro3' =>'之前我不相信一见钟情，但是见到你的那一刻，我否定了我的看法。我的心为你沦陷，从此只为你跳动',
                'pro4' =>'有一种爱的感觉，叫感同身受。有一种爱的默契，叫心有灵犀。有一种爱的承诺，叫天长地久',
                'pro5' =>'爱的，我明白你对我付出了最大的耐心、包容心、关心...... 你的心情总会因为我而变化，我很抱歉在未来的日子你还会受这份苦， 亲爱的，我们还太年轻未来还有很长的路要走'
            ];
        }

        if ($area == 13) {
            $list = [
                'title' => '我们的爱情',
                'manuser' => '我叫你的名字',
                'wouser' =>'我叫她的名字',
                'times' =>time(),
                'pro1' =>'我们的相遇是意外的，但这是一个美丽幸福的意外，让我遇到了这么好的你',
                'pro2' =>'莎士比亚说过：爱情是一种甜蜜的痛苦，但是我愿意忍受这种痛苦，莎士比亚还说过，世界上没有比服侍爱情更快乐的了，你愿不愿意享受这种快乐？当然你是愿意的~嘿嘿',
                'pro3' =>'之前我不相信一见钟情，但是见到你的那一刻，我否定了我的看法。我的心为你沦陷，从此只为你跳动',
                'pro4' =>'有一种爱的感觉，叫感同身受。有一种爱的默契，叫心有灵犀。有一种爱的承诺，叫天长地久',
                'pro5' =>'爱的，我明白你对我付出了最大的耐心、包容心、关心...... 你的心情总会因为我而变化，我很抱歉在未来的日子你还会受这份苦， 亲爱的，我们还太年轻未来还有很长的路要走',
                'pro6' =>'莎士比亚还说过，世界上没有比服侍爱情更快乐的了，你愿不愿意享受这种快乐？',
                'url' =>''
            ];
        }

        if ($area == 12) {
            $list = [
                'title' => '生日快乐',
                'manuser' => '周广腾',
                'wouser' =>'陈雪',
                'pro1' =>'亲爱的宝贝',
                'pro2' =>'在你生日到来之际，我将快乐的音符，作为礼物送给你愿您拥有365个美丽的日子，衷心地祝福你，生日快乐！在此诚挚地献上我的三个祝愿：一愿你身体健康；二愿你幸福快乐；三愿你万事如意！',
                'pro3' =>'送你一个生日蛋糕，祝你生日快乐！第一层，体贴！第二层，关怀！第三层，浪漫！第四层，温馨！中间夹层，甜蜜！祝你天天都有一份好心情！',
                'url' =>''
            ];
        }

        if ($area == 11) {
            $list = [
                'title' => '多屏滚动表白网页',
                'manuser' => '周广腾',
                'wouser' =>'陈雪',
                'pro1' =>'亲爱的宝贝',
                'pro2' =>'你是一个活泼 可爱的女孩 很善良，天真浪漫',
                'pro3' =>'虽然我们接触的时间不长，只有短短几个月',
                'pro4' =>'却让我感觉是那么的熟悉与开心',
                'pro5' =>'难以忘记初次见面的感觉，我被一种神奇的东西吸引',
                'pro6' =>'那时我的心七上八下的，我相信这就是一见钟情',
                'pro7' =>'那以后，你的一个微笑，一个表情，都深深的留在了我的心里',
                'pro8' =>'我一次次的更加确定，你就是我一直等待的人',
                'pro9' =>'只要你愿意,我可以陪你去任何你想去的地方',
                'pro10' =>'只要你愿意,我可以陪你去吃任何你喜欢吃的东西',
                'url' =>''
            ];
        }

        if ($area == 10) {
            $list = [
                'title' => '爱情树表白网页',
                'manuser' => '周广腾',
                'wouser' =>'陈雪',
                'pro1' =>'亲爱的宝贝',
                'pro2' =>'你是一个活泼 可爱的女孩 很善良，天真浪漫',
                'pro3' =>'虽然我们接触的时间不长，只有短短几个月',
                'pro4' =>'却让我感觉是那么的熟悉与开心',
                'pro5' =>'难以忘记初次见面的感觉，我被一种神奇的东西吸引',
                'pro6' =>'那时我的心七上八下的，我相信这就是一见钟情',
                'pro7' =>'那以后，你的一个微笑，一个表情，都深深的留在了我的心里',
                'pro8' =>'我一次次的更加确定，你就是我一直等待的人',
                'pro9' =>'只要你愿意,我可以陪你去任何你想去的地方',
                'url' =>''
            ];
        }

        if ($area == 9) {
            $list = [
                'title' => '男孩给女孩送花 ',
                'manuser' => '周广腾',
                'wouser' =>'陈雪',
                'pro1' =>'亲爱的宝贝',
                'url' =>''
            ];
        }

        if ($area == 8) {
            $list = [
                'title' => '浪漫爱心表白网页',
                'manuser' => '周广腾',
                'wouser' =>'陈雪',
                'pro1' =>'亲爱的宝贝',
                'pro2' =>'你是一个活泼 可爱的女孩 很善良，天真浪漫',
                'pro3' =>'虽然我们接触的时间不长，只有短短几个月',
                'pro4' =>'却让我感觉是那么的熟悉与开心',
                'pro5' =>'难以忘记初次见面的感觉，我被一种神奇的东西吸引',
                'pro6' =>'那时我的心七上八下的，我相信这就是一见钟情',
                'pro7' =>'那以后，你的一个微笑，一个表情，都深深的留在了我的心里',
                'pro8' =>'我一次次的更加确定，你就是我一直等待的人',
                'pro9' =>'只要你愿意,我可以陪你去任何你想去的地方',
                'url' =>''
            ];
        }

        $this->assign('list',$list);
        return $this->fetch($area.'ls');
    }
}
