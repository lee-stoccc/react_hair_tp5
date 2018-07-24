<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24
 * Time: 16:28
 */

namespace app\index\controller;

use think\Controller;
use app\index\model\Hairorder;

class Hairorderc extends Controller
{
    // 收藏商品 status=5
    public function addGoodCar(){
        header('Access-Control-Allow-Origin:*');
        $uid=input('uid');
        $cid=input('cid');
        $goodsid=input('goodsid');
        $goodnum=input('goodnum');
        $hairorder=new Hairorder();
        $status=input('status');
        $res=$hairorder->addGoodCar($cid,$uid,$goodsid,$goodnum,$status);
        return $res;
    }

    // 统计未付款的数量
    public function ordstatus_0(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $uid=input('uid');
        $status=input('status');
        $Hairorder=new Hairorder();
        // 把未付款列表都查询出来
        $data=$Hairorder->ordstatus_0($cid,$uid,$status);
        $status_0_sum=0;
        foreach ($data as $k=>$v){
            $status_0_sum=$status_0_sum+$data[$k]['goodnum'];
        }
        return array('num'=>$status_0_sum);
    }

    // 购买商品,支付改商品status状态
    public function ordstatus_1(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $uid=input('uid');
        $goodsid=input('goodsid');
        $goodnum=input('goodnum');
        $status=input('status');
        $hairorder=new Hairorder();
        $res=$hairorder->ordstatus_1($cid,$uid,$status,$goodsid,$goodnum);
        return $res;
    }
}