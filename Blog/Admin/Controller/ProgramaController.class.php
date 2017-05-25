<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

class ProgramaController extends CommonController {
    //栏目列表
    public function programaList(){
        $programa=M('Programa');
        //排序输出列表
        $info=$programa->order('programa_rank')->select();

        $this -> assign('info', $info);
        $this -> display();
    }
    //栏目添加
    public function programaAdd(){
        $programa=M('Programa');
        if(!empty($_POST)){
            $programa->create();
            $z=$programa->add();
            if($z){
                $this->ajaxReturn(true);
            }else {
                $this->ajaxReturn(false);
            }
        }else{      
            $this->display();       
        }
    }
    //栏目修改
    public function programaUpdate($id=""){
        $programa=M('Programa');
        if(!empty($_POST)){             
            $programa->create();
            $z=$programa->save();
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $info=$programa->find($id);

            $this->assign('info',$info);
            $this->display();
        }
    }
    //文章栏目删除
    public function programaDelete($id=""){
        $programa=M('Programa');
        // 判断内部是否有内容
        $article=M('Article');
        $info=$article
            ->where('article_programa='.$id)
            ->find();
        if(!empty($info)){
            $this->ajaxReturn(false);
        }else{
            $z=$programa->delete($id);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }
    }
    // 文章栏目选择删除
    public function programaDeleteAll(){
        $programa=M('Programa');
        $ID_Delete=implode(",", I('post.ID_Delete'));
        // var_dump(I('post.ID_Delete'));
        // exit();
        if(!$ID_Delete){
            $this->ajaxReturn(false);
            exit();
        }
        $ID_Delete1=$_POST['ID_Delete'];
        $flag=0;
        // 判断内部是否有内容
        for ($i=0; $i < count($ID_Delete1); $i++) { 
            $article=M('Article');
            $info=$article
                ->where('article_programa='.$ID_Delete1[$i])
                ->find();
            if(!empty($info)){
                $flag=1;
            }
        }
        if($flag==1){
            $this->ajaxReturn(false);
        }else{ 
            $z=$programa->delete($ID_Delete);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }
    }

    /**
    * ajax 校验名称是否存在
    **/
    public function validateName(){
        $programa=M('Programa');
        $data['programa_name']=$_POST['programa_name'];
        $z=$programa->where($data)->find();

        if(!empty($z)){
            $this->ajaxReturn(false);
        }else{
            $this->ajaxReturn(true);
        }
    }
    // 修改名称检验
    public function validateNameUpdate(){
        $programa=M('Programa');
        // 该名字是否是自己本身
        $info['programa_id']=$_POST['programa_id'];
        $info['programa_name']=$_POST['programa_name'];
        $j=$programa->where($info)->find();
        if(!empty($j)){
            $this->ajaxReturn(true);
        }else{
            $data['programa_name']=$_POST['programa_name'];
            $z=$programa->where($data)->find();

            if(!empty($z)){
                $this->ajaxReturn(false);
            }else{
                $this->ajaxReturn(true);
            }
        }
    }
}