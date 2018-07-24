<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 21:37
 */

namespace app\index\controller;


use think\Collection;
use think\Controller;
use app\index\model\Hairshop;

class Hairshopc extends Controller
{
    // 商铺列表
    public function shoplist(){
        header('Access-Control-Allow-Origin:*');
        $con=input('cid');
        $uid=input('uid');
        $shop=new Hairshop();
        $data=$shop->shoplist($con,$uid);
        if($data){
            echo json_encode($data);
        }else{
            echo json_encode(array('code'=>-1));
        }
    }

    // 关注店铺
    public function addcarenum(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $shopid=input('shopid');
        $shop=new Hairshop();
        $saveres=$shop->addcarenum($cid,$shopid);
        if($saveres){
            return array('code'=>1);
        }else{
            return array('code'=>-1);
        }


    }

    public function searchname(){
        header('Access-Control-Allow-Origin:*');
        $con=input('name');
        $shop=new Hairshop();
        $data=$shop->searchshop($con);
        if($data){
            echo json_encode($data);
        }else{
            echo json_encode(array('code'=>1));
        }
    }

    // 保存关注店铺
    public function saveusecareshop(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $uid=input('uid');
        $shopid=input('shopid');
        $hairshopcarenum=new Hairshop();
        $save=$hairshopcarenum->saveusecareshop($cid,$uid,$shopid);
        if($save){
            return array('code'=>1,'msg'=>$save);
        }else{
            return array('code'=>-1,'msg'=>$save);
        }
    }

}