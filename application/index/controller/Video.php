<?php

namespace app\index\controller;

use app\common\controller\IndexBase;
use think\Cache;
use think\Controller;
use think\Db;

class Video extends IndexBase
{
    public function index(){
    	$list = Db::name('article')->where('cid',8)->order('sort desc,id desc')->paginate(9);
    	$this->assign('list', $list);
    	return $this->fetch();
    }


    public function make(){
    	$str = $_SERVER["QUERY_STRING"];
      	$area = cut_str($str,'/',-1);	

        Db::name('article')->where('id',$area)->setInc('reading');

        $list = Db::name('article')->where('id',$area)->find();

        $videolist = Db::name('article')->where('id','neq',$area)->where('cid',8)->limit('8')->select();

        $this->assign('list', $list);
        $this->assign('videolist',$videolist);
        return $this->fetch();
    }

}