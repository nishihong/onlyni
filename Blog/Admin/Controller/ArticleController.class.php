<?php
namespace Admin\Controller;
use Admin\Common;
use Admin\Controller\CommonController;

class ArticleController extends CommonController {
    //文章列表
    public function articleList(){
        $article=M('Article');

        //分页
        $total=$article->count();
        $per=10;
        $page=new Common\Page($total,$per);

        $info=$article
                ->alias('a')
                ->field('a.article_id,a.article_title,a.article_origin,p.programa_name,a.article_pic,a.article_hit,a.article_datetime,a.article_top')
                ->join('left join ni_programa p on a.article_programa=p.programa_id')
                ->order('a.article_top desc,a.article_id desc')
                ->limit($page->limit)
                ->select();

        $this->assign('info',$info);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

        // 栏目信息
        $programa=M('Programa');
        $info=$programa->select();

        $this->assign('programaInfo',$info); 

        $this->display();
    }
    //文章添加
    public function articleAdd(){
        if(!empty($_POST)){
            $article=M('Article');
            $data=$article->create();
            $data['article_datetime']=date('Y-m-d H:i:s');
            // 修改时间戳 排序
            if($_POST['article_top']==0){
                $data['article_top']=0;
            }else{
                $data['article_top']=time();
            }

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/article/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件
            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['article_pic']="/Upload/article/".$info['article_pic']['savename'];
            }

            $z=$article->add($data);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            //栏目信息
            $programa=M('Programa');
            $info=$programa->select();
            $this->assign('programaInfo',$info);

            $this->display();
        }
    }
    //文章修改
    public function articleUpdate($id=""){
        $article=M('Article');
        if(!empty($_POST)){
            $data=$article->create();

            // 修改时间戳 排序
            if($_POST['article_top']==0){
                $data['article_top']=0;
            }else{
                $data['article_top']=time();
            }

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/article/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件
            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['article_pic']="/Upload/article/".$info['article_pic']['savename'];

                // 删除原图片文件
                $file = $_POST['delete_pic'];
                $file = substr($file,1);
                unlink($file);
            }else{
                unset($data['article_pic']);
            }

            $z=$article->save($data);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $info=$article->find($id);
            $info['article_content']=htmlspecialchars_decode($info['article_content']);
            $this->assign('info',$info);

            //栏目信息
            $programa=M('Programa');
            $info=$programa->select();
            $this->assign('programaInfo',$info); 

            $this->display();
        }
    }
    //文章栏目查找
    public function articleQuery($id=""){
        // $id=$_GET['article_programa'];
        if($id==0){
            $this->redirect('Article/articleList');
        }else{
            $article=M('Article');

            $total=$article
                    ->alias('a')
                    ->where('a.article_programa='.$id)
                    ->count();
            $per=10;
            $page=new Common\Page($total,$per);

            $info=$article
                    ->alias('a')
                    ->field('a.article_id,a.article_title,p.programa_name,a.article_origin,a.article_pic,a.article_hit,a.article_datetime,a.article_top')
                    ->where('p.programa_id='.$id)
                    ->join('left join ni_programa p on a.article_programa=p.programa_id')
                    ->order('a.article_top desc,a.article_id desc')
                    ->limit($page->limit)
                    ->select();

            $this->assign('info',$info);

            $pagelist=$page->fpage();

            $this->assign('pagelist',$pagelist);

            //栏目信息
            $programa=M('Programa');
            $info=$programa->select();
            $this->assign('programaInfo',$info); 

            $this->display('Article/articleList');
        }
    }
    //文章删除
    public function articleDelete($id=""){
        $article=M('Article');
        // 删除原图片文件
        $info=$article->field('article_pic')->find($id);
        $file = $info['article_pic'];
        $file = substr($file,1);
        unlink($file);

        $z=$article->delete($id);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    // 文章批量删除
    public function articleDeleteAll(){
        $article=M('Article');
        $ID_Delete=implode(",", I('post.ID_Delete')); 

        // 删除原图片文件
        $ID_Delete1=I('post.ID_Delete');
        for ($i=0; $i < count($ID_Delete1) ; $i++) {
            $info=$article->field('article_pic')->find($ID_Delete1[$i]);
            $file = $info['article_pic'];
            $file = substr($file,1);
            unlink($file);
        }

        $z=$article->delete($ID_Delete);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
}