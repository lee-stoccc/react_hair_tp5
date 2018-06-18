<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 6:41
 */

namespace app\index\model;
use think\Db;
use think\model;

class Female
{
    public function getFemaleInfo($id){
        $con=new Db();
        $getTable=$con::table('female');
        if($id=='list'){   //全表查询
            $getData= $getTable->field('*')->order('creat_time')->select();
            return $getData;
        }else{   // 单条数据查询
            $getData=$getTable->field('*')->where('id',$id)->find();
            return $getData;
        }
    }

    public function saveInfos($data){
        $con=new Db();
        $conn=$con::table('female')->insert($data);
        if($conn){
            return true;
        }else{
            return false;
        }
    }
}