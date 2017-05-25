<?php
namespace Home\Controller;
use Home\Common;
use Home\Controller\CommonController;

class GuestbookController extends CommonController {
    public function guestbook(){
        // 留言板信息
        $guestbook = M('Guestbook');        
        $total = $guestbook-> count();
        $per=5;
        $page=new Common\Page($total,$per);

        $info=$guestbook
                ->alias('g')
                ->field('g.guestbook_id,g.guestbook_name,g.guestbook_pic,g.guestbook_datetime,g.guestbook_ip,g.guestbook_url,g.guestbook_content,g.guestbook_from,g.reply_datetime,g.reply_content')
                ->order('g.guestbook_id desc')
                ->limit($page->limit)
                ->select();

        // ip替换
        $newIp = new \Org\Util\IP();
        for ($i=0; $i < count($info); $i++) {
          $info[$i]['guestbook_ip'] = getIpaddr($info[$i]['guestbook_ip'],$newIp);
        }  
        $this->assign('guestbookInfo',$info);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

    	// 右侧信息
    	$about=M('About');
    	$info=$about
    			->field('about_net_name,about_name,about_birthday,about_native_place_province,about_native_place_city,about_native_place_dist,about_present_address_province,about_present_address_city,about_present_address_dist,about_job,about_favorite_book,about_favorite_music,about_favorite_star')
    			->select();
    	
    	$this->assign('info',$info[0]);

        $this->display();
    }

    // 验证码
    public function verify() {
        ob_clean();
        $verify = new \Think\Verify();
        $verify->codeSet = '0123456789';
        $verify->fontSize = '14px';
        $verify->imageW = 95;
        $verify->imageH = 30;
        $verify->length = 4;
        $verify->useCurve = false;
        $verify->useNoise = false;
        $verify->entry();
    }

    // 发表留言
    public function guestbookAdd(){
        //验证码校验
        $verify = new \Think\Verify();
        if (!$verify->check($_POST['codecheck'])) {
            $this->ajaxReturn(false);
            exit();
        }
        
        $guestbook=M('Guestbook');
        // 获取数据做判断 防止 xss sql注入
        // I方法过滤非法数据
        $data['guestbook_name']=I('post.guestbook_name','','string');
        $data['guestbook_email']=I('post.guestbook_email','','email');
        $data['guestbook_content']=I('post.guestbook_content','','string');
        $data['guestbook_url']=I('post.guestbook_url','','url');

        $guestbook_datetime = strtotime(date("Y-m-d H:i:s", time()));
        $data['guestbook_datetime'] = $guestbook_datetime;

        // $data['guestbook_ip'] = get_client_ip();
        $data['guestbook_ip'] = getIp();
        // $data['guestbook_ip'] =$_SERVER['REMOTE_ADDR'];
        $data['guestbook_from'] = getOs();

        // 获取缓存信息  上一次提交的信息
        // $guestbook_pic = $guestbook->where(array('email' => $email))->getField('guestbook_pic');
        
        // 如果qq有登录的话用qq头像
        if (session('qqimg')) {
            $guestbook_pic =session('qqimg');
        }else{ //否则随机生成头像
            $guestbook_pic = '/Public/home/img/photo/' . mt_rand(1, 75) . '.jpg';
        }

        $data['guestbook_pic'] = $guestbook_pic;


        if ($guestbook->add($data)) {
            // 发送到这个邮箱提醒
            SendMail('249183418@qq.com',$_POST['guestbook_name'],"留言邮箱:".$_POST['guestbook_email']."<br>留言内容:".$_POST['guestbook_content']."<br>留言主页:".$_POST['guestbook_url']);
            // if(SendMail($_POST['guestbook_email'],$_POST['guestbook_name'],$_POST['guestbook_content'])){
            //     $this->ajaxReturn(true);
            // }else{
            //    $this->ajaxReturn(false);
            // }
            $this->ajaxReturn(true);
        } else {
            $this->ajaxReturn(false);
        }
    }
}