<?php
namespace app\common\controller;

use app\common\controller\HomeBase;
use think\Cache;
use think\Db;
use think\Session;

class IndexBase extends HomeBase
{
    public $user_id;
    public $user;
    protected $baseConfig;
    protected function _initialize()
    {
        parent::_initialize();
        if (!Session::has('user_id')) {
            /*$this->redirect("index/login/index");
            exit;*/
        }
        $this->user_id=Session::get('user_id')?Session::get('user_id'):0;
        //$this->user=Db::name('user')->find($this->user_id);
        $this->user = model('User')->find($this->user_id);
        $this->baseConfig = unserialize(get_unserialize(Db::name('system')->where('name','site_config')->value('value')));
        $this->assign('user',$this->user);
        $this->assign('baseConfig',$this->baseConfig);
        $this->assign('url',$_SERVER['HTTP_HOST']);
        $this->assign('user_id',Session::get('user_id')?Session::get('user_id'):0);
    }

}