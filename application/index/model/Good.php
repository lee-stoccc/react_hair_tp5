<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/13
 * Time: 20:45
 */

namespace app\index\model;


use think\Db;

class Good
{
    // 查询商品列表
    public function goodlist($cid){
        $db=new Db();
        $res=$db::table('hairgood')
            ->field('*')
            ->where('cid','=',$cid)
            ->limit(10)
            ->select();
        if ($res){
            return $res;
        }else{
            return false;
        }
    }

    // 查询商品详情
    public function gooddetail($cid,$id){
        $db=new Db();
        $res=$db::table('hairgood')->field('*')->where('cid','=',$cid)->where('id','=',$id)
            ->find();
        if($res){
            return $res;
        }else{
            return false;
        }

    }
}