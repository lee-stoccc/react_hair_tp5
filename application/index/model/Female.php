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
    public function getFemaleInfo($id,$num){
        $con=new Db();
        $getTable=$con::table('female');
        if($id=='list'){   //全表查询
            $getData= $getTable->field('*')->order('creat_time')->page($num,6)->select();
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

    // 查询关注的人数
    public function attention($id){
        $db=new Db();
        $res=$db::table('female')->field('attention')->where('id',$id)->find();
        if ($res){
            return $res;
        }else{
            return array('code'=>0);
        }
    }

    // 增加人数，并且更新保存到数据库
    public function addAttendtion($id){
        $res =$this->attention($id);
        $res['attention']+=1;
        $db=new Db();
        $res=$db::table('female')->where('id',$id)->update($res);
        if($res){
            return true;
        }else{
            return false;
        }
    }

}