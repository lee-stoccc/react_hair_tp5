<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/13
 * Time: 20:49
 */

namespace app\index\controller;

use app\index\model\Good;
class Goodc
{
    // 商品列表
    public function goodlists(){
        header('Access-Control-Allow-Origin:*');
        $con=input('cid');
        $good=new Good();
        $datas=$good->goodlist($con);
        if($datas){
            return $datas;
        }else{
            return array('code'=>-1);
        }
    }

    // 商品详情
    public function gooddetail(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $id=input('id');
        $good=new Good();
        $datas=$good->gooddetail($cid,$id);
        if($datas){
            return $datas;
        }else{
            return array('code'=>-1);
        }
    }

    // 关注商品
    public function addcarenum(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $shopid=input('goodid');
        $shop=new Good();
        $saveres=$shop->addcarenum($cid,$shopid);
        if($saveres){
            return array('code'=>1);
        }else{
            return array('code'=>-1);
        }


    }
    // 保存关注商品
    public function saveusecareshop(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $uid=input('uid');
        $shopid=input('goodid');
        $hairshopcarenum=new Good();
        $save=$hairshopcarenum->saveusecareshop($cid,$uid,$shopid);
        if($save){
            return array('code'=>1,'msg'=>$save);
        }else{
            return array('code'=>-1,'msg'=>$save);
        }
    }

    // 查询是否有收藏商品
    public function isaddgood(){
        header('Access-Control-Allow-Origin:*');
        $cid=input('cid');
        $uid=input('uid');
        $shopid=input('goodid');
        $hairshopcarenum=new Good();
        $res=$hairshopcarenum->isaddgood($cid,$uid,$shopid);
        if($res){
            return $res;
        }else{
            return array('msg'=>'未收藏此商品');
        }
    }
}