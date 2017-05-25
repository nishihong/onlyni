<?php
namespace Admin\Controller;
use Admin\Common;
use Admin\Controller\CommonController;

class GuestbookController extends CommonController{
    //留言板列表
    public function guestbook(){
        $guestbook=M('Guestbook');

        //分页
        $total=$guestbook->count();
        $per=10;
        $page=new Common\Page($total,$per);
        
        // $sql="select ni_guestbook.guestbook_id,ni_guestbook.guestbook_name,ni_guestbook.guestbook_content,ni_guestbook.guestbook_datetime,ni_guestbook.guestbook_ip,ni_guestbook.guestbook_from,ni_guestbook.guestbook_email,ni_guestbook.guestbook_url,ni_guestbook.reply_datetime from ni_guestbook order by ni_guestbook.guestbook_id desc ".$page->limit;
        // $info=$guestbook->query($sql);

        $info=$guestbook
                ->alias('g')
                ->field('g.guestbook_id,g.guestbook_name,g.guestbook_content,g.guestbook_datetime,g.guestbook_ip,g.guestbook_from,g.guestbook_email,g.guestbook_url,g.reply_datetime')
                ->order('g.guestbook_id desc')
                ->limit($page->limit)
                ->select();

        // ip替换
        $newIp = new \Org\Util\IP();
        for ($i=0; $i < count($info); $i++) {
          $info[$i]['guestbook_ip'] = getIpaddr($info[$i]['guestbook_ip'],$newIp);
        }  

        $this -> assign('info', $info);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

        $this -> display();
    }
    //留言板回复
    public function guestbookReply($id=""){
        $guestbook=M('Guestbook');
        if(!empty($_POST)){
            $data=$guestbook->create();
            if($data['reply_content']==""){
                $data['reply_datetime']=0;
            }else{
                $data['reply_datetime']=time();
            }

            $z=$guestbook->save($data);
            if($z){
                //如果要发送邮件提醒  发送
                if($_POST['if_remind']==1){                    
                    SendMail($_POST['guestbook_email'],'小倪博客 提醒您，有人回复你啦~！',"小倪博客 回复说: ".$_POST['reply_content']."<br>去回复: http://www.onlyni.com/guestbook <br>此邮件来自：小倪博客 请勿回复~！ ");
                }
                $this->ajaxReturn(true);
            }else {
                $this->ajaxReturn(false);
            }
        }else{
            $info=$guestbook->find($id);
            // ip替换
            $newIp = new \Org\Util\IP();
            $info['guestbook_address'] = getIpaddr($info['guestbook_ip'],$newIp);
            $this->assign('info',$info);

            $this->display();
        }
    }
    //留言板删除
    public function guestbookDelete($id=""){
        $guestbook=M('Guestbook');

        $z=$guestbook->delete($id);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    // 留言板选择删除
    public function guestbookDeleteAll(){
        $guestbook=M('guestbook');
        $ID_Delete=implode(",", I('post.ID_Delete'));
        if(!$ID_Delete){
            $this->ajaxReturn(false);
            exit();
        }

        $z=$guestbook->delete($ID_Delete);
        if($z){
            $this->ajaxReturn(true);
        }else{     
            $this->ajaxReturn(false);
        }
    }
}