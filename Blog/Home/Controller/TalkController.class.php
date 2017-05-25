<?php
namespace Home\Controller;
use Home\Common;
use Home\Controller\CommonController;

class TalkController extends CommonController {
    public function talk(){
    	$talk=M('Talk');

    	//分页
        $total=$talk->count();
        $per=10;
        $page=new Common\Page($total,$per);

        $info=$talk
                ->alias('t')
                ->field('t.talk_id,t.talk_content,t.talk_pic,t.talk_date')
                ->order('t.talk_top desc,t.talk_id desc')
                ->limit($page->limit)
                ->select();

        $this -> assign('info', $info);

        $pagelist=$page->fpage();

        $this->assign('pagelist',$pagelist);

        $this->display();
    }
}