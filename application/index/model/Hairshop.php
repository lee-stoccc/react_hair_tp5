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
    public function shoplist($cid){
        $db=new Db();
        $datas=$db::table('hairshop')->field('*')->where('cid','=',$cid)->limit(10)->select();
        return $datas;
    }

    // 根据输入框搜索
    public function searchshop($name){
        $db=new Db();
        $datas=$db::table('hairshop')->field('*')->where('shopname','like','%'.$name.'%')->select();
        return $datas;

    }
}