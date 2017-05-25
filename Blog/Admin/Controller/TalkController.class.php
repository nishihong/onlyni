<?php
namespace Admin\Controller;
use Admin\Common;
use Admin\Controller\CommonController;

class TalkController extends CommonController{
    //说说列表
    public function talk(){
        $talk=M('Talk');

        //分页
        $total=$talk->count();
        $per=10;
        $page=new Common\Page($total,$per);

        $info=$talk
                ->alias('t')
                ->field('t.talk_id,t.talk_content,t.talk_pic,t.talk_date,t.talk_top')
                ->order('t.talk_top desc,t.talk_id desc')
                ->limit($page->limit)
                ->select();

        $this -> assign('info', $info);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

        $this -> display();
    }
    // 说说添加
    public function talkAdd(){
        $talk=M('Talk');
        if(!empty($_POST)){
            $data=$talk->create();

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/talk/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件
            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['talk_pic']="/Upload/talk/".$info['talk_pic']['savename'];
            }

            // 修改时间戳 排序
            if($_POST['talk_top']==0){
                $data['talk_top']=0;
            }else{
                $data['talk_top']=time();
            }
            $data['talk_date']=date('Y-m-d');

            $z=$talk->add($data);
            if($z){
                $this->ajaxReturn(true);
            }else {
                $this->ajaxReturn(false);
            }
        }else{     
            $this->display();       
        }
    }
    //说说修改
    public function talkUpdate($id=""){
        $talk=M('Talk');
        if(!empty($_POST)){
            $data=$talk->create();

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/talk/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件
            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['talk_pic']="/Upload/talk/".$info['talk_pic']['savename'];

                // 删除原图片文件
                $file = $_POST['delete_pic'];
                $file = substr($file,1);
                // echo $file;
                unlink($file);
            }else{
                unset($data['talk_pic']);
            }

            // 修改时间戳 排序
            if($_POST['talk_top']==0){
                $data['talk_top']=0;
            }else{
                $data['talk_top']=time();
            }

            $z=$talk->save($data);
            if($z){
                $this->ajaxReturn(true);
            }else {
                $this->ajaxReturn(false);
            }
        }else{
            $info=$talk->find($id);
            $this->assign('info',$info);

            $this->display();
        }
    }
    //说说删除
    public function talkDelete($id=""){
        $talk=M('Talk');
        // 删除原图片文件
        $info=$talk->field('talk_pic')->find($id);
        $file = $info['talk_pic'];
        $file = substr($file,1);
        unlink($file);

        $z=$talk->delete($id);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    // 说说选择删除
    public function talkDeleteAll(){
        $talk=M('Talk');
        $ID_Delete=implode(",", I('post.ID_Delete'));
        if(!$ID_Delete){
            $this->ajaxReturn(false);
            exit();
        }
        // 删除原图片文件
        $ID_Delete1=I('post.ID_Delete');
        for ($i=0; $i < count($ID_Delete1) ; $i++) {
            $info=$talk->field('talk_pic')->find($ID_Delete1[$i]);
            $file = $info['talk_pic'];
            $file = substr($file,1);
            unlink($file);
        }

        $z=$talk->delete($ID_Delete);
        if($z){
            $this->ajaxReturn(true);
        }else{     
            $this->ajaxReturn(false);
        }
    }
}