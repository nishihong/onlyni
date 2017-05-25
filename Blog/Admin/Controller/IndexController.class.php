<?php
namespace Admin\Controller;
// use Think\Controller;
use Admin\Controller\CommonController;

class IndexController extends CommonController {
    public function index(){
    	// 个人信息
    	$admin=M('Admin');
    	$info=$admin->join('ni_role ON ni_admin.role_id = ni_role.role_id')->find($_SESSION['adminId']);
    	$this->assign('personal',$info);

    	// 管理员个数
    	$info=$admin->field('count(*) as count')->select();
    	$this->assign('admin',$info['0']);

    	// 文章数目
        $article=M('Article');
        $info=$article->field('count(*) as count')->select();
        $this->assign('article',$info['0']);

        // 文章栏目数目
    	$programa=M('Programa');
    	$info=$programa->field('count(*) as count')->select();
    	$this->assign('programa',$info['0']);

        // 说说数目
        $talk=M('Talk');
        $info=$talk->field('count(*) as count')->select();
        $this->assign('talk',$info['0']);

        // 留言数目
        $guestbook=M('Guestbook');
        $info=$guestbook->field('count(*) as count')->select();
        $this->assign('guestbook',$info['0']);

        // 相册数目
        $photo=M('Photo');
        $info=$photo->field('count(*) as count')->select();
        $this->assign('photo',$info['0']);

        // 相片数目
        $picture=M('Picture');
        $info=$picture->field('count(*) as count')->select();
        $this->assign('picture',$info['0']);

    	$this->display();
    }
}