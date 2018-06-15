<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 11:22
 */

namespace app\index\controller;
use think\Cache;   //Cache 文件缓存
use think\Controller;
use think\Session;

//模型名字和控制器名字重复会有冲突
//use \app\index\model\Order;
class Order extends Controller
{
    // 我的订单(订单)查询列表
    public function order($uid){
        header('Access-Control-Allow-Origin:*');
        if(!Cache::has($uid.'ord')){
            $get_moder=new  \app\index\model\Order();
            $data = $get_moder->check_order($uid);
            Cache::set($uid.'ord',$data,60);
            return json_encode($data);
        }else{
            $data=Cache::get($uid.'ord');
            return json_encode($data);
        }
    }

    //我的订单表（收藏）查询
    public function col($uid){
        header('Access-Control-Allow-Origin:*');
        if(!Cache::has($uid.'col')){
            $connect = new \app\index\model\Order();
            $data = $connect->cols($uid);
            Cache::set($uid.'col',$data,60);
            return json_encode($data);
        }else{
            $data=Cache::get($uid.'col');
            return json_encode($data);
        }
    }

    // 查询全表
    public function getAll(){
        header('Access-Control-Allow-Origin:*');
        $get_model= new \app\index\model\Order();
        $data=$get_model->getAll();
        return json_encode($data);
    }
}
