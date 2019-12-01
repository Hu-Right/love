<?php

namespace app\index\controller;

use app\common\controller\IndexBase;
use think\Cache;
use think\Controller;
use think\Db;

class Index extends IndexBase
{
    public function index(){
        $list = Db::name('article')->where('cid','9')->order('id desc')->paginate(5);
        $music = Db::name('music')->order('id desc')->find();

        $this->assign('list', $list);
        $this->assign('music',$music);
        return $this->fetch();
    }


    public function add(){
    	$data = input('post.');
    	$list = Db::name('pingjia')->insert($data);
    	if ($list) {
    		return ['success' => '0'];
    	}
    	return ['success' => '1'];
    }
}
