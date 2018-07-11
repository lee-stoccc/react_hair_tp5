<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 20:35
 */

namespace app\index\model;


use think\Db;
use think\Model;

class HairIndex
{
    // 查询首页栏目和其他全部数据
    public function index($cid){
        $db=new Db();
        $datas=$db::table('hairIndex')->field('*')->where('cid','=',$cid)->limit(10)->find();
        return $datas;
    }


}