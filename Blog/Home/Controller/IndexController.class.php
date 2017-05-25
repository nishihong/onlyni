<?php
namespace Home\Controller;
use Home\Controller\CommonController;

class IndexController extends CommonController {
    public function index(){
        // 相册
        $photo=M('Photo');
        $photoInfo=$photo
                ->field('photo_id,photo_name,photo_pic')
                ->limit('0,5')
                ->select();
        $this->assign('photoInfo',$photoInfo);

        // 文章
        $article=M('Article');
        //分页
        // 文章信息
    	$articleInfo=$article
    				->field('article_id,article_title,programa_name,article_programa,article_datetime,article_origin,article_intro,article_pic')
    				->join('left join ni_programa on ni_article.article_programa=ni_programa.programa_id')
    				->order('article_top desc,article_id desc')
    				->limit('0,7')
    				->select();

        $this->assign('articleInfo',$articleInfo);

        // 右侧的信息

        // 最新文章
        $newArticleInfo=$article
        				->field('article_id,article_title')
        				->order('article_id desc')
        				->limit('0,8')
        				->select();
        $this->assign('newArticleInfo',$newArticleInfo);

        // 文章点击排行
        $hitArticleInfo=$article
                        ->field('article_id,article_title')
                        ->order('article_hit desc')
                        ->limit('0,5')
                        ->select();
        $this->assign('hitArticleInfo',$hitArticleInfo);

        // 友情链接列表
        $link=M('Link');
        $linkInfo=$link
    				->field('link_name,link_url')
                    ->where('if_show=1')
    				->order('link_rank,link_id')
    				->select();
        $this->assign('linkInfo',$linkInfo);
        // dump($linkInfo);
        // exit();

        $this->display();
    }

    // 测试邮箱发送的
    // public function test(){
    //     SendMail('249183418@qq.com', "我是内容", "我是真的内容");
    // }
}