<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/31
 * Time: 18:09
 */

namespace app\index\model;

use think\Db;
class Hairdesigner
{
    // 查询某一店铺的设计师资料
    public function designer($cid,$shopid){
        $db=new Db();
        $designer=$db::table('Hairdesigner')->field('*')->where('cid','=',$cid)
            ->where('shopid','=',$shopid)->select();
        if($designer){
            return $designer;
        }else{
            return array('msg'=>'查无数据或查询错误m');
        }
    }
}