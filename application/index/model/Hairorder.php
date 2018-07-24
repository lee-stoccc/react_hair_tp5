<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24
 * Time: 16:28
 */

namespace app\index\model;
use think\Db;

class Hairorder
{
    // 添加收藏或者点击购买未付款
    public function addGoodCar($cid,$uid,$goodsid,$goodnum,$status){
        $db=new Db();
        $datas=$db::table('hairorder')->field('id,goodnum')->where('cid','=',$cid)->where('uid','=',$uid)
            ->where('goodsid','=',$goodsid)->where('status','=',$status)->find();
        // 查询数据库，如果之前没有收藏，则insert保存
        if(empty($datas)){
            $saveDatas=$db::table('hairorder')->insert(array('cid'=>$cid,'uid'=>$uid,'goodsid'=>$goodsid,'goodnum'=>$goodnum
                                    ,'status'=>$status));
            if($saveDatas){
                return array('msg'=>'收藏成功');
            }else{
                return array('msg'=>'收藏失败');
            }
            // 如果之前有收藏，则相加后来收藏的数目
        }else{
            $datas['goodnum']=(int)$datas['goodnum']+(int)$goodnum;
            $updatas=$db::table('hairorder')->where($datas['id'])->update($datas);
            if($updatas){
                return array('msg'=>'更新收藏数目成功');
            }else{
                return array('msg'=>'更新收藏数目失败');
            }
        }
    }

    // 未付款列表
    public function ordstatus_0($cid,$uid,$status){
        $db=new Db();
        // 把未付款列表查询出来
        $datas=$db::table('hairorder')->where('cid','=',$cid)->where('uid','=',$uid)->where('status','=',$status)->select();
        if($datas){
            return $datas;
        }else{
            return false;
        }
    }

    // 支付成功，但未发货，更改status=0->status=1
    public function ordstatus_1($cid,$uid,$status,$goodsid,$goodnum){
        // 先查询是否未付款/购物车订单，即数据库有记录，如果有记录，更改数据库status状态
        $db=new Db();
        $isset=$this->ordstatus_0($cid,$uid,0);
        $isset2=$this->ordstatus_0($cid,$uid,5);
        if($isset!==false && $isset2!==false){           // 如果查询结果有数据
            foreach ($isset as $k=>$y){
                if($isset[$k]['goodsid']==$goodsid){        // 找到付款的订单号，根据goodsid查找，然后更改该订单status
                    $isset[$k]['status']=1;
                    $id=$isset[$k]['id'];
                    $updata=$isset[$k];
                    $upstatus=$db::table('hairorder')->where('id','=',$id)->update($updata);
                    if($upstatus){
                        return array('msg'=>'付款成功，订单状态st=1');
                    }else{
                        return array('msg'=>'付款失败，订单状态st=0');
                    }
                }
                break;
            }
        }else{
            $saveDatas=$db::table('hairorder')->insert(array('cid'=>$cid,'uid'=>$uid,'goodsid'=>$goodsid,'goodnum'=>$goodnum
            ,'status'=>$status));
            if($saveDatas){
                return array('msg'=>'付款成功，订单状态为1');
            }else{
                return array('msg'=>'创建订单、付款失败');
            }
        }
    }
}