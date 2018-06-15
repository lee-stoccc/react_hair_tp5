<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 10:37
 */

namespace app\index\model;
use think\Db;
use think\Controller;

class Order
{
    // 我的订单(订单)查询列表
    public function check_order($uid){
        $base = new Db();

        // 二表查询，根据条件成立一张新表，再根据条件$uid 查询
        $datas = $base::table('order')->field('order.*,title.*')->join('title','order.gid=title.id')->
        where('uid','=',$uid)->select();
        return $datas;
    }

    public function cols($uid){
        $base = new Db();
        $datas = $base::table('collect')->field('collect.*,title.*')->join('title','collect.gid=title.id')->
            where('uid','=',$uid)->select();
        return $datas;
    }

    public function getAll(){
        $base=new Db();
        $datas=$base::table('order')->field('*')->find();
        return $datas;
    }
}
