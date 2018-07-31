<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 21:34
 */

namespace app\index\model;
use think\Db;

class Hairshop
{
    // 包含关注功能
    public function shoplist($cid,$uid){
        $db=new Db();
        $datas1=$db::table('hairshop')->alias('a')->field('a.*')->where('cid','=',$cid)
            ->limit(10)->select();
        $datas2=$db::table('hairshopcarenum b')->field('b.shopid,b.uid')->where('uid','=',$uid)->select();
        foreach ($datas1 as $k=>$v){
            foreach ($datas2 as $k2=>$v2){
                if ($datas1[$k]['shopid']==$datas2[$k2]['shopid']){
                    $datas1[$k]['uid']=$datas2[$k2]['uid'];
                    break;
                }else{
                    $datas1[$k]['uid']='-9999';
                }
            }
        }
        return $datas1;
    }

    // 根据输入框搜索
    public function searchshop($name){
        $db=new Db();
        $datas=$db::table('hairshop')->field('*')->where('shopname','like','%'.$name.'%')->select();
        return $datas;
    }

    // 关注人数+1
    public function addcarenum($cid,$shopid){
        $db=new Db();
        $datas=$db::table('hairshop')->where(['cid'=>$cid,'shopid'=>$shopid])->setInc('shopcarenum');
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    // 关注人数-1
    public function areducecarenum($cid,$shopid){
        $db=new Db();
        $datas=$db::table('hairshop')->where(['cid'=>$cid,'shopid'=>$shopid])->setDec('shopcarenum');
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    // 取消关注商店
     public  function  cencelcareshop($cid,$uid,$shopid){
        $db=new Db();
        $cencel=$db::table('hairshopcarenum')->where('cid','=',$cid)
            ->where('uid','=',$uid)->where('shopid','=',$shopid)->delete();
     }

    // 保存用户关注的商店
    public function saveusecareshop($cid,$uid,$shopid){
        $db=new Db();
        // 判断是否已经关注过此店铺
        $issave=$db::table('hairshopcarenum')->field('*')->where('cid','=',$cid)
                ->where('uid','=',$uid)
                ->where('shopid','=',$shopid)->find();
        if($issave){
            $this->areducecarenum($cid,$shopid);
            $this->cencelcareshop($cid,$uid,$shopid);   // 取消关注，并把关注表的数据删除
            return array('code'=>'-2','msg'=>'该用户已经关注过此商铺');   // 该用户已经关注过此商铺
        }else{
            // 保存在用户、商户、关注表里面
            $save=$db::table('hairshopcarenum')->insert(array('uid'=>$uid,'shopid'=>$shopid,'cid'=>$cid));
            // 商户表的关注人数+1
            $this->addcarenum($cid,$shopid);
            if($save){
                return true;
            }else{
                return false;
            }
        }
    }

    // 查询是否有关注店铺
    public function isaddgood($cid,$uid,$shopid){
        $db=new Db();
        // 判断是否已经关注过此店铺
        $issave=$db::table('hairshopcarenum')->field('*')->where('cid','=',$cid)
            ->where('uid','=',$uid)
            ->where('shopid','=',$shopid)->find();
        return $issave;
    }

    // 查询单一店铺详细信息
    public function shopdetail($cid,$shopid){
          $db=new  Db ();
           $shopdetail= $db::table('hairshop')->field('*')->where('cid','=', $cid)
               ->where('shopid', '=' , $shopid)->find();
           if($shopdetail){
               return  $shopdetail;
           }else{
               return array('msg'=>'查无此店铺信息或查询错误');
           }
    }
}