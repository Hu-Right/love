<?php
namespace app\admin\controller;

use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;
use app\common\controller\AdminBase;
use think\Db;

class Picturez  extends AdminBase
{
	protected $article_model;
    protected $category_model;

    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 管理
     */
    public function index()
    {
    	$category_level_list = Db::name('Picturez')->order('id desc')->paginate('15');
        $this->assign('category_level_list', $category_level_list);
        return $this->fetch();
    }


    public function cate_edit()
    {
        $id=$this->request->param('id');
        $pid=$this->request->param('pid');
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $shu['title'] = $data['name'];
            $shu['img'] = $data['thumb'];
            $list = Db::name('picturez')->insert($shu);
            if ($list) {
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
        }
        return $this->fetch();
    }


     public function cate_edits($id){
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $shu['title'] = $data['name'];
            $shu['img'] = $data['thumb'];
            $list = Db::name('picturez')->where('id',$data['id'])->update($shu);
            if ($list) {
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
        }
        $list = Db::name('picturez')->where('id',$id)->find();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function set($id){
    	if ($this->request->isPost()) {
            $data            = $this->request->param();
            $shu['size'] = $data['size'];
            $shu['sizecol'] = $data['sizecol'];
            $shu['incline'] = $data['incline'];
            $shu['location1'] = $data['x1'].','.$data['y1'];
            $shu['location2'] = $data['x2'].','.$data['y2'];
            $shu['type'] =$data['type'];
            $list = Db::name('picturez')->where('id',$data['id'])->update($shu);
            if ($list) {
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
        }
    	$list = Db::name('picturez')->where('id',$id)->find();
    	if (empty($list['incline'])) {
    		$list['incline'] = 0;
    	}
    	if (empty($list['sizecol'])) {
    		$list['sizecol'] = '#ffffff';
    	}
    	if (empty($list['size'])) {
    		$list['size'] = '30';
    	}
    	if (empty($list['location1'])) {
    		$list['x1'] = '0';
    		$list['y1'] = '0';
    	}else{
    		$arr = explode(',',$list['location1']);
    		$list['x1'] = $arr[0];
    		$list['y1'] = $arr[1];
    	}
    	if (empty($list['location2'])) {
    		$list['x2'] = '0';
    		$list['y2'] = '0';
    	}else{
    		$arr = explode(',',$list['location2']);
    		$list['x2'] = $arr[0];
    		$list['y2'] = $arr[1];
    	}
        $this->assign('list',$list);
        return $this->fetch();
    }


    public function cate_delete($id)
    {
        if (Db::name('picturez')->delete($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}