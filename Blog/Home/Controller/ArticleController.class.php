<?php
namespace Home\Controller;
use Home\Common;
use Home\Controller\CommonController;

class ArticleController extends CommonController {
	//文章列表
    public function article(){
        $article=M('Article');

        //分页
        $total=$article->count();
        $per=5;
        $page=new Common\Page($total,$per);

        $info=$article
                ->alias('a')
                ->field('a.article_id,a.article_origin,a.article_title,p.programa_name,a.article_pic,a.article_datetime,a.article_intro,a.article_programa')
                ->join('left join ni_programa p on a.article_programa=p.programa_id')
                ->order('a.article_top desc,a.article_id desc')
                ->limit($page->limit)
                ->select();

        $this->assign('articleInfo',$info);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

        // 右侧的信息

        // 栏目信息
        $programa=M('Programa');
        $info=$programa->select();

        $this->assign('programaInfo',$info); 

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

        $this->display();
    }
    //文章详情
    public function articleDetails($id="",$articlePage="1"){
        // echo $id;
        // echo $page;
        // exit();
    	$article=M('Article');

    	// 文章信息
    	$articleInfo=$article
    				->field('article_id,article_title,programa_name,article_top,article_programa,article_datetime,article_origin,article_hit,article_content')
    				->join('left join ni_programa on ni_article.article_programa=ni_programa.programa_id')
    				->find($id);

        // 如果文章信息不存在，跳到empty页面
        if(empty($articleInfo)){
            R('Empty/_empty');
            exit;
        }

    	/*标签的转换*/
        $articleInfo['article_content']=htmlspecialchars_decode($articleInfo['article_content']);

        /************长文章分页功能开始*******************/
        // 获取当前第几页 不存在就从第一页开始
        // $articlePage=I('get.page',0);

        $info=explode("_ueditor_page_break_tag_",$articleInfo['article_content']);
        // 分成了几页  全部数字+1
        // $articlePage+=1; //数字+1
        $page=count($info)+1;
        if($page>2){
            // 分页列表
            $pagelist="";
            // echo $pagelist;
            for($i=1;$i<$page;$i++){
                if($i==$articlePage){    
                    $pagelist.="<a href='###' class='active'>$i</a>";    
                }else{    
                    $pagelist.="<a href='".__ROOT__."/articleDetails-$id/p-$i'>$i</a>";    
                }
            }

            $this->assign('pagelist',$pagelist);
            $articlePage=$articlePage-1; //数字-1
            $articleInfo['article_content']=$info[$articlePage];
        }
        /************长文章分页功能结束*******************/

    	$this->assign('articleInfo',$articleInfo);	

        //文章点击量+1
        $data['article_id']=$id;
        $data['article_hit']=$articleInfo['article_hit']+'1';
        $article->save($data); 	

        /***************** 相关文章开始******************************/
        // 先取出除了自身的所有文章取出存进数组
        $aboutArticleInfo=$article
                ->field('article_id,article_title')
                ->where('article_id!='.$id)
                ->select(); 
        //判断相关字节大小从高到低排序
        $arr_len= count($aboutArticleInfo); 
        for($i=0; $i<=($arr_len-1); $i++){ 
            //取得两个字符串相似的字节数 
            // echo $aboutArticleInfo[$i]['article_title'];
            $arr_similar[$i] = similar_text($aboutArticleInfo[$i]['article_title'],$articleInfo['article_title']); 
        } 
        arsort($arr_similar); //按照相似的字节数由高到低排序 
        reset($arr_similar); //将指针移到数组的第一单元 
        $index= 0; 
        foreach($arr_similar as $old_index=>$similar){ 
            $newAboutArticleInfo[$index] = $aboutArticleInfo[$old_index]; 
            $index++; 
        } 
        // 取前十个数据
        $newAboutArticleInfo=array_slice($newAboutArticleInfo,0,10);
        $this->assign('newAboutArticleInfo',$newAboutArticleInfo); 
        /***************** 相关文章结束******************************/

        $top=$articleInfo['article_top'];
        //文章上一篇  置顶+排序的顺序
        $before=$article
                ->field('article_id,article_title')
                ->where("(article_top>".$top.") or (article_top=".$top." and article_id>".$id.")")
                ->order('article_top,article_id')
                ->limit('1')
                ->find(); 
        $this->assign('before',$before); 
        
        //文章下一篇 置顶+排序的顺序
        $after=$article
                ->field('article_id,article_title')
                ->where("(article_top<".$top.") or (article_top=".$top." and article_id<".$id.")")
                ->order('article_top desc,article_id desc')
                ->limit('1')
                ->find();
        $this->assign('after',$after);

        $programa=$articleInfo['article_programa'];
        // 最新栏目文章
        $newArticleInfo=$article
                        ->field('article_id,article_title')
                        ->where('article_programa='.$programa)
                        ->order('article_id desc')
                        ->limit('0,8')
                        ->select();
        $this->assign('newArticleInfo',$newArticleInfo);

        // 栏目文章点击排行
        $hitArticleInfo=$article
                        ->field('article_id,article_title')
                        ->where('article_programa='.$programa)
                        ->order('article_hit desc')
                        ->limit('0,5')
                        ->select();
        $this->assign('hitArticleInfo',$hitArticleInfo);

        $this->display();
    }
    //文章栏目查找
    public function articleQuery($id=""){
        $article=M('Article');

        //分页
        $sql="select count(*) as count from ni_article where ni_article.article_programa=".$id;
        $total=$article->query($sql);

        $total=$article
                ->alias('a')
                ->where('a.article_programa='.$id)
                ->count();
        $per=5;
        $page=new Common\Page($total,$per);

        $info=$article
                ->alias('a')
                ->field('a.article_id,a.article_origin,a.article_title,a.article_pic,a.article_hit,p.programa_name,a.article_pic,a.article_datetime,a.article_intro,a.article_programa')
                ->join('left join ni_programa p on a.article_programa=p.programa_id')
                ->where('p.programa_id='.$id)
                ->order('a.article_top desc,a.article_id desc')
                ->limit($page->limit)
                ->select();

        $this->assign('articleInfo',$info);

		// 跳回一个值，判断栏目状态
        $this->assign('status',$info[0]['programa_name']);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

        //栏目信息
        $programa=M('Programa');
        $info=$programa->select();
        $this->assign('programaInfo',$info); 

        // 最新文章
        $newArticleInfo=$article
        				->field('article_id,article_title')
                        ->where('article_programa='.$id)
                        ->order('article_id desc')
        				->limit('0,8')
        				->select();
        $this->assign('newArticleInfo',$newArticleInfo);

        // 文章点击排行
        $hitArticleInfo=$article
        				->field('article_id,article_title')
                        ->where('article_programa='.$id)
        				->order('article_hit desc')
        				->limit('0,5')
        				->select();
        $this->assign('hitArticleInfo',$hitArticleInfo);

        $this->display('Article/article');
    }
}