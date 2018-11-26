<?php

/**
 * Created by PhpStorm.
 * User: yangxianhuo
 * Date: 2018/11/21
 * Time: 12:18 AM
 */
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    const ERROR_CODE = 100;
    const SUCCESS_CODE = 200;

    public function index(){
        $uid = 1;

        $list_arr = M('list')->where("status = 1")->select();
        $list_title = [];
        foreach ($list_arr as &$list){
            $list['tags'] =  str_replace(array('，',' '),',',$list['tags']);
            $list['tags'] = explode(',', $list['tags']);

            foreach ($list['tags'] as $l){
                $list_title[] =  $l;
            }
        }
        $list_title = array_unique($list_title);
        $list_group = [];
        foreach ($list_title as $key => $t){
            $list_group[$key]['group_title']  = $t;
            foreach ($list_arr as $key2 =>  $m){
                if(in_array($t,$m['tags'])){
                    $list_group[$key]['group_list'][] = $m;
                }
            }
            if(count($list_group[$key]['group_list']) > 6){
                $list_group[$key]['group_list'] = array_slice($list_group[$key]['group_list'],0,5);
                $list_group[$key]['group_list'][6] = [
                    'name' => '查看更多>>',
                    'is_more' => 1
                ];
            }
        }
//        user_list
        $user_list = M('user')->where("status = 1")->field('id,username')->limit(7)->order('id desc')->select();
        if(count($user_list) > 6){
            $user_list = array_slice($user_list,0,5);
            $user_list[5] = [
                'username' => '查看更多>>',
                'is_more' => 1
            ];
        }


//        all list
        $all_list = M('list')->where('is_public = 1 and status = 1')->order('id desc')->limit(9)->select();

        $this->assign(compact('list_group','user_list','all_list'));
        $this->display();
    }

    public function homepage(){
        $paruid = $_GET['uid'];
        $uid = 1;
        if($paruid =='' && $uid ==''){
            die('请登录');

        }
        $select_uid = $uid;
        if($paruid == '' || ($paruid == $uid)){
            $self = 1;

        }else{
            $self = 0;
            $select_uid = $paruid;
        }
        if($self ==1){
            $is_public = '(1,2)';
        }else{
            $is_public = '(1)';
        }
        $list_arr = M('list')->where("uid = {$select_uid} and is_public in {$is_public} and status = 1")->select();
        $list_title = [];
        foreach ($list_arr as &$list){
            $list['tags'] =  str_replace(array('，',' '),',',$list['tags']);
            $list['tags'] = explode(',', $list['tags']);

            foreach ($list['tags'] as $l){
                $list_title[] =  $l;
            }
        }
        $list_title = array_unique($list_title);
        $list_group = [];
        foreach ($list_title as $key => $t){
            $list_group[$key]['group_title']  = $t;
            foreach ($list_arr as $key2 =>  $m){
                if(in_array($t,$m['tags'])){
                    $list_group[$key]['group_list'][] = $m;
                }
            }
            if(count($list_group[$key]['group_list']) > 6){
                $list_group[$key]['group_list'] = array_slice($list_group[$key]['group_list'],0,5);
                $list_group[$key]['group_list'][6] = [
                    'name' => '查看更多>>',
                    'is_more' => 1
                ];
            }

        }

        $this->assign(compact('list_group','self','select_uid'));
        $this->display();
    }


    public function add(){
        $this->display();
    }
    public function addHandle(){
        try {

            $uid = 1;
            $list_arr['uid'] = $uid ?? '';
            $list_arr['name'] = $_POST['name'] ?? '';
            $list_arr['create_time'] = time();
            $list_arr['update_time'] = time();
            $list_arr['tags'] = $_POST['tags'] ?? '';
            $list_arr['is_public'] = $_POST['is_public'] ?? '';
            $list_arr['desc'] = $_POST['desc'] ?? '';
            $list_arr['status'] = 1;
            if(!$list_arr['uid']){
                throw new \Exception('未登录');
            }
            if(!$list_arr['name'] || !$list_arr['uid']){
                throw new \Exception('清单名称不能为空');
            }

            $list_id  =  M('list')->add($list_arr);
            $items = json_decode($_POST['items'],true);

            foreach ($items as &$item){
                $item['list_id'] =  $list_id;
                $item['status'] =  1;
                $item['is_done'] =  1;
                $item['img_url'] = json_encode($item['img_url']);
            }
            M('listitem')->addAll($items);
            self::returnSuccess('添加成功');
        } catch (\Exception $e) {
            self::returnError($e->getMessage());
        }

    }

    public function detail(){


        try{
            $uid = 1;

            $list_id = $_GET['listid'];
            if(!$list_id){
                throw new \Exception('清单ID不能为空');
            }
            $listinfo = M('list')->where("id = {$list_id}")->find();
            if($uid != $listinfo['uid'] && $listinfo['is_public'] ==2){
                throw new \Exception('清单不存在');
            }
            $userinfo = M('user')->where("id = {$listinfo['uid']}")->find();
            $list_item = M('listitem')->where("list_id = {$list_id}")->order('id asc')->select();

            if(!empty($listinfo)){
                $listinfo['tags'] =  str_replace(array('，',' '),',',$listinfo['tags']);
                $listinfo['tags'] = explode(',', $listinfo['tags']);
            }

            foreach ($list_item as &$val){
                $val['img_url'] = json_decode($val['img_url'],true);
            }

            $this->assign(compact('list_item','listinfo','userinfo'));

            $this->display();
        } catch (\Exception $e) {
            self::returnError($e->getMessage());
        }



    }


    public function additem(){
        $list_id = $_POST['list_id'];
        if($list_id){
//            初始化item
           $item_id = M('listitem')->add(array('list_id'=>$list_id));
        }
        $this->assign('item_id',$item_id);
        $this->display();
    }
    public function delitem(){
        $item_id = $_POST['item_id'];
        if($item_id){
            $item_id = M('listitem')->where("id = {$item_id}")->save(array('status'=>0));
        }
        echo 1;
    }


    public function more_list(){
        try {
            $uid = 1;
            $is_public = '(1)';
            $select_uid = $_POST['select_uid'];
            $tags = $_POST['tags'];
            $list_id = rtrim($_POST['list_id'],',');
            if($paruid =='' && $uid ==''){
                die('请登录');

            }
            if($uid ==$select_uid && $select_uid){
                $is_public = '(1,2)';
            }
            if($select_uid){
                $whers = " and uid = {$select_uid}";
            }else{
                $whers = '';
            }

            $list_arr = M('list')->where("  id not in ($list_id) and is_public in {$is_public} and tags like '%{$tags}%'  and status = 1 {$whers} ")->limit(8)->select();
            if(count($list_arr) > 7){
                $list_arr = array_slice($list_arr,0,6);
                $list_arr[6] = [
                    'name' => '查看更多>>',
                    'is_more' => 1
                ];
            }
            if(empty($list_arr)){
                die();
            }
            $this->assign('group_list',$list_arr);
            $this->assign('tags',$tags);
            $this->assign('select_uid',$select_uid);
            $this->display();

        } catch (\Exception $e) {
            self::returnError($e->getMessage());
        }



    }


    public function more_list_user(){
        try{
            $page = $_POST['page'] ?? 1;
            $limit = 5;
            $sta = ($page-1)*$limit;
            $user_list = M('user')->where("status = 1")->field('id,username')->limit($sta,$limit+3)->order('id desc')->select();
            if(count($user_list) > 7){
                $user_list = array_slice($user_list,0,6);
                $user_list[6] = [
                    'username' => '查看更多>>',
                    'is_more' => ++$page
                ];
            }

//            _print_f($user_list);
            if(empty($user_list)){
                die();
            }
            $this->assign(compact('user_list'));
            $this->display();


        } catch (\Exception $e) {
            self::returnError($e->getMessage());
        }

    }

    public function loading(){

        $p = $_POST['p'] ?? 1;
        $limit = 9;
        $sta = $p*$limit;
        $all_list = M('list')->where('is_public = 1 and status = 1')->order('id desc')->limit($sta,9)->select();
        if(empty($all_list)){
            die();
        }
        $p++;
        if(count($all_list) < $limit ){
            $is_not = 1;
        }
        $this->assign(compact('all_list','p','is_not'));
        $this->display();

    }

    public function edit(){


        try{
            $uid = 1;

            $list_id = $_GET['listid'];
            if(!$list_id){
                throw new \Exception('清单ID不能为空');
            }
            $listinfo = M('list')->where("id = {$list_id} and status =1")->find();
            if(($uid != $listinfo['uid'] && $listinfo['is_public'] ==2) || empty($listinfo)){
                throw new \Exception('清单不存在');
            }
            $userinfo = M('user')->where("id = {$listinfo['uid']}")->find();
            $list_item = M('listitem')->where("list_id = {$list_id} and status = 1")->order('id asc')->select();

//            if(!empty($listinfo)){
//                $listinfo['tags'] =  str_replace(array('，',' '),',',$listinfo['tags']);
//                $listinfo['tags'] = explode(',', $listinfo['tags']);
//            }

            foreach ($list_item as &$val){
                $val['img_url'] = json_decode($val['img_url'],true);
            }

            $this->assign(compact('list_item','listinfo','userinfo'));

            $this->display();
        } catch (\Exception $e) {
            self::returnError($e->getMessage());
        }
    }


    public function editHandle(){

        $list_id  = $_POST['list_id'];
        $item_id  = $_POST['item_id'];
        $type  = $_POST['type'];
        $val  = $_POST['val'];
        $is_public  = $_POST['is_public'];
        $img_url  = json_decode($_POST['img_url'],true);

        if($is_public){

            M('list')->where("id = {$list_id} ")->save(array("is_public" => $is_public,'update_time' => time()));
            exit(0);
        }

        if(!empty($img_url)){
            $img_url=array_filter($img_url);
            $img_url = json_encode($img_url);
            M('listitem')->where("list_id = {$list_id} and id = {$item_id}")->save(array("img_url" => $img_url));
            exit(0);
        }

        if($item_id){
            M('listitem')->where("list_id = {$list_id} and id = {$item_id}")->save(array("{$type}" => $val));
            exit(0);
        }elseif($list_id){
            M('list')->where("id = {$list_id} ")->save(array("{$type}" => $val,'update_time' => time()));
            exit(0);
        }

    }


    /***************************************  public   **********************************************/

    public function send(){
        $_POST['mail'] = 'yangxianhuo@outlook.com';
        $_POST['title'] = 'test';
        $_POST['content'] = 'test';
        if(SendMail($_POST['mail'],$_POST['title'],$_POST['content']))
            echo '发送成功';
        else
            echo '发送失败';
    }

    /**
     * @param array $data
     * @return string
     */
    public static function returnSuccess($data,$status = self::SUCCESS_CODE)
    {
        header('Content-type: application/json');
        @ob_clean();
        $result = array(
            'status' => $status,
            'data' => $data,
        );

        echo json_encode($result);
        exit(0);
    }

    /**
     * @param string $message : 错误信息
     * @param int $status
     * @return string
     */
    public static function returnError($data, $status = self::ERROR_CODE)
    {
        header('Content-type: application/json');
        @ob_clean();
        $result = array(
            'status' => $status,
            'data' => $data,
        );
        echo json_encode($result);
        exit(0);

    }
}
