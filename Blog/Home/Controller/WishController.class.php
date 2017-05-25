<?php
namespace Home\Controller;
use Home\Common;
// use Think\Controller;
use Home\Controller\CommonController;

class WishController extends CommonController {
    public function __construct(){
        parent::__construct();//一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
    }

    public function index(){
        $this->redirect('wish');
    }


    public function wish(){
        $wish = M('Wish');
        $info = $wish->select();
        $this->assign('info',$info);
        $this->display();
    }

    public function add_note(){
        $this->display();
    }

    // 修改位置
    public function updatePosition(){
        $wish = M('Wish');

        if (!is_numeric(I('get.id')) || !is_numeric(I('get.x')) || !is_numeric(I('get.y')) || !is_numeric(I('get.z'))){
            exit();
        }

        //判断是否可以移动位置
        $result = $wish->find(I('get.id'));
        if($result['is_lock'] == 1){
            exit();
        }

        $data['wish_id']  = I('get.id');
        $data['wish_xyz'] = I('get.x').'|'.I('get.y').'|'.I('get.z');

        $info = $wish->save($data);
    }

    // 锁定状态
    public function Lock(){
        $wish = M('Wish');

        if (!is_numeric($_GET['id'])){
            exit();
        }

        $data['wish_id'] = I('get.id');
        $data['is_lock'] = 1;

        $info = $wish->save($data);
    }

    // 删除
    public function delete(){
        if (empty($_SESSION['adminName'])) {
            exit;
        }
        
        $wish = M('Wish');
    	$wish_id = intval($_GET['id']);

    	$result = $wish->delete($wish_id);
        echo $result;
    }

    //添加 
    public function add(){
    	$wish = M('Wish');

        // I方法过滤非法数据
    	$data['wish_name']	 	= I('post.username','','string');
    	$data['wish_content'] 	= I('post.content','','string');
        if(empty($data['wish_name']) || empty($data['wish_content'])){
            $this->ajaxReturn('出错了！');
        }
    	$data['wish_color'] 	= mt_rand(1,5);

    	$data['wish_addtime'] 	= strtotime(date("Y-m-d H:i:s", time()));

    	$data['wish_ip'] 		= getIp();
        $data['wish_from'] 		= getOs();

        $left = intval($_POST['left']);
        $top = intval($_POST['top']);
        $zIndex = intval($_POST['zIndex']);
        $data['wish_color'] = intval($_POST['color_id']);
        if ($data['wish_color'] < 0 or $data['wish_color'] > 5) {
            $data['wish_color'] = rand(1, 5);
        }
        $data['wish_xyz'] = '' . $left . '|' . $top . '|' . $zIndex;

        $result = $wish->add($data);
    	if ($result) {
            $this->ajaxReturn($result);
        } else {
            $this->ajaxReturn('出错了！');
        }
    }
}