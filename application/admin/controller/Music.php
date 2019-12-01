<?php
namespace app\admin\controller;

use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;
use app\common\controller\AdminBase;
use think\Db;

class Music extends AdminBase
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
        $category_level_list = Db::name('music')->order('id desc')->paginate('15');
        $this->assign('category_level_list', $category_level_list);
        return $this->fetch();
    }


    /**
     * 编辑
     */
    /**
     * 编辑栏目
     * @param $id
     * @param $pid
     * @return mixed
     */
    public function cate_edit()
    {
        $id=$this->request->param('id');
        $pid=$this->request->param('pid');
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $shu['title'] = $data['name'];
            $shu['url'] = $data['thumb'];
            $list = Db::name('music')->insert($shu);
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
            $shu['url'] = $data['thumb'];
            $list = Db::name('music')->where('id',$data['id'])->update($shu);
            if ($list) {
                $this->success('保存成功',url('index'));
            }
            $this->error('保存失败');
        }
        $list = Db::name('music')->where('id',$id)->find();
        $this->assign('list',$list);
        return $this->fetch();
    }


    public function cate_delete($id)
    {
        if (Db::name('music')->delete($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
    
}