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
}