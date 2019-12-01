<?php

namespace app\index\controller;

use app\common\controller\IndexBase;
use think\Cache;
use think\Controller;
use think\Db;
use think\Session;

class Pic extends IndexBase
{
    public function index(){
    	$list = Db::name('picture')->order('id desc')->paginate(12);
    	$this->assign('list', $list);
    	return $this->fetch();
    }

    public function make(){
        $str = $_SERVER["QUERY_STRING"];
     
      	$area = cut_str($str,'/',-1);	

        Db::name('picture')->where('id',$area)->setInc('reading');

        $list = Db::name('picture')->where('id',$area)->find();

        $videolist = Db::name('picture')->where('id','neq',$area)->limit('8')->select();

        $x =  $area -1;
        dump($x);
        die;
        $xia = Db::name('picture')->where('id',$x)->find();
        if (empty($xia)) {
            $xia['start'] = 0;
        }else{
            $xia['start'] = 1;
        }

        $s = $area +1;
        $shang = Db::name('picture')->where('id',$s)->find();
        if (empty($shang)) {
            $shang['start'] = 0;
        }else{
            $shang['start'] = 1;
        }

        $this->assign('shang',$shang);
        $this->assign('xia',$xia);
        $this->assign('list', $list);
        $this->assign('videolist',$videolist);
        return $this->fetch();
    }


    public function imgs(){
    	$id = input('post.id');
    	$one = input('post.one');
    	$two = input('post.two');

    	$list = Db::name('picture')->where('id',$id)->find();
    	$size = $list['size'];
    	$color = $list['sizecol'];
        $wz=explode(',',$list['location1']);
        $img =substr($list['img'],1);
        $incline = $list['incline'];

        $image = \think\Image::open($img);
        $rand  = rand(1000,9999);
        $url = 'public/create/'.$rand.'.png';
        if ($list['type'] == 0) {
	        $image->text($one,'HYQingKongTiJ.ttf',$size,$color,$wz,'WATER_SOUTHEAST',$incline)->save($url);
	        if (!empty($two)) {
	        	$image = \think\Image::open($url);
		        $url = 'public/create/'.$rand.'.png';
		        $wz=explode(',',$list['location2']);
		        $image->text($two,'HYQingKongTiJ.ttf',$size,$color,$wz,'WATER_SOUTHEAST',$incline)->save($url);
	        }
        }else{
           $arr  = str_split($one,3);
           foreach ($arr as $key => $value) {
           		if ($key == 0) {
           			$image->text($value,'HYQingKongTiJ.ttf',$size,$color,$wz,'WATER_SOUTHEAST',$incline)->save($url);
           		}else{
           			$image = \think\Image::open($url);
			        $url = 'public/create/'.$rand.'.png';
			        if ($key == 1) {
			        	$wz=explode(',',$list['location1']);
			        	$wz[1] = $size + $wz[1] + 18;
			        }else{
			        	$wz[1] = $size + $wz[1] + 18;
			        }
			        $image->text($value,'HYQingKongTiJ.ttf',$size,$color,$wz,'WATER_SOUTHEAST',$incline)->save($url);
           		}
           }
        }

      
        return ['success' => '0','msg'=>$url];
    }
}