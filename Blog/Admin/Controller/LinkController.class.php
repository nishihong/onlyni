<?php
namespace Admin\Controller;
use Admin\Common;
use Admin\Controller\CommonController;

class LinkController extends CommonController{
    //友情链接列表
    public function link(){
        $link=M('Link');

        //分页
        $total=$link->count();
        $per=10;
        $page=new Common\Page($total,$per);

        $info=$link
                ->alias('l')
                ->field('l.link_id,l.link_name,l.link_intro,l.link_email,l.link_name,l.link_url,l.if_show,l.link_rank')
                ->order('l.link_rank,l.link_id')
                ->limit($page->limit)
                ->select();

        $this -> assign('info', $info);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

        $this -> display();
    }
    // 友情链接添加
    public function linkAdd(){
        $link=M('Link');
        if(!empty($_POST)){
            $data=$link->create();

            $z=$link->add($data);
            if($z){
                $this->ajaxReturn(true);
            }else {
                $this->ajaxReturn(false);
            }
        }else{     
            $this->display();       
        }
    }
    //友情链接修改
    public function linkUpdate($id=""){
        $link=M('Link');
        if(!empty($_POST)){
            $data=$link->create();

            $z=$link->save($data);
            if($z){
                $this->ajaxReturn(true);
            }else {
                $this->ajaxReturn(false);
            }
        }else{
            $info=$link->find($id);
            $this->assign('info',$info);

            $this->display();
        }
    }
    //友情链接删除
    public function linkDelete($id=""){
        $link=M('Link');

        $z=$link->delete($id);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    // 友情链接选择删除
    public function linkDeleteAll(){
        $link=M('Link');
        $ID_Delete=implode(",", I('post.ID_Delete'));
        if(!$ID_Delete){
            $this->ajaxReturn(false);
            exit();
        }

        $z=$link->delete($ID_Delete);
        if($z){
            $this->ajaxReturn(true);
        }else{     
            $this->ajaxReturn(false);
        }
    }
}