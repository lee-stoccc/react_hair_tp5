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

    // 关注人数+1
    public function addcarenum($cid,$shopid){
        $db=new Db();
        $datas=$db::table('hairgood')->where(['cid'=>$cid,'goodid'=>$shopid])->setInc('goodcarenum');
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    // 关注人数-1
    public function areducecarenum($cid,$shopid){
        $db=new Db();
        $datas=$db::table('hairgood')->where(['cid'=>$cid,'goodid'=>$shopid])->setDec('goodcarenum');
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    // 取消关注商品
    public  function  cencelcareshop($cid,$uid,$shopid){
        $db=new Db();
        $cencel=$db::table('hairgoodcarenum')->where('cid','=',$cid)
            ->where('uid','=',$uid)->where('goodid','=',$shopid)->delete();
    }

    // 保存用户关注的商品
    public function saveusecareshop($cid,$uid,$shopid){
        $db=new Db();
        // 判断是否已经关注过此店铺
        $issave=$db::table('hairgoodcarenum')->field('*')->where('cid','=',$cid)
            ->where('uid','=',$uid)
            ->where('goodid','=',$shopid)->find();
        if($issave){
            $this->areducecarenum($cid,$shopid);
            $this->cencelcareshop($cid,$uid,$shopid);   // 取消关注，并把关注表的数据删除
            return array('code'=>'-2','msg'=>'该用户已经关注过此商铺');   // 该用户已经关注过此商铺
        }else{
            // 保存在用户、商户、关注表里面
            $save=$db::table('hairgoodcarenum')->insert(array('uid'=>$uid,'goodid'=>$shopid,'cid'=>$cid));
            // 商户表的关注人数+1
            $this->addcarenum($cid,$shopid);
            if($save){
                return true;
            }else{
                return false;
            }
        }
    }

    // 查询是否有收藏商品
    public function isaddgood($cid,$uid,$shopid){
        $db=new Db();
        // 判断是否已经关注过此店铺
        $issave=$db::table('hairgoodcarenum')->field('*')->where('cid','=',$cid)
            ->where('uid','=',$uid)
            ->where('goodid','=',$shopid)->find();
        return $issave;
    }
}