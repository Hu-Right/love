<?php

namespace app\index\controller;

use app\common\controller\IndexBase;
use think\Cache;
use think\Controller;
use think\Db;

class Idea extends IndexBase
{
    public function index(){
    	$list = Db::name('article')->where('cid','9')->order('id desc')->paginate(12);
    	$this->assign('list', $list);
    	return $this->fetch();
    }

    public function make(){
    	$str = $_SERVER["QUERY_STRING"];
      	$area = cut_str($str,'/',-1);	

        Db::name('article')->where('id',$area)->setInc('reading');

        $x =  $area -1;
        $xia = Db::name('article')->where('cid',9)->where('id',$x)->find();
        if (empty($xia)) {
            $xia['start'] = 0;
        }else{
            $xia['start'] = 1;
        }

        $s = $area +1;
        $shang = Db::name('article')->where('cid',9)->where('id',$s)->find();
        if (empty($shang)) {
            $shang['start'] = 0;
        }else{
            $shang['start'] = 1;
        }

        $alist = Db::name('article')->where('id',$area)->find();

        $videolist = Db::name('article')->where('cid',9)->where('id','neq',$area)->order('id')->paginate(8);
        $this->assign('shang',$shang);
        $this->assign('xia',$xia);
        $this->assign('videolist',$videolist);
        $this->assign('alist',$alist);
		return $this->fetch();      	
    }

}