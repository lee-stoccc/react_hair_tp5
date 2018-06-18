<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 6:48
 */

namespace app\index\controller;
use think\Db;
use  think\db\connector;


class Female
{
    public function getFemaleInfo(){
        header('Access-Control-Allow-Origin:*');
        $id=input('id');
        $connect=new \app\index\model\Female;
        $getData=$connect->getFemaleInfo($id);
        $getDatas['data']=$getData;
        if($getDatas){
            $getDatas['info']=1;
            return $getDatas;
        }else{
            $getDatas['info']=0;
            return $getDatas;
        }
    }

    public function saveInfo(){
        header('Access-Control-Allow-Origin:*');
        $data=[
            'f_age'=>input('age'),
            'f_name'=>input('name'),
            'f_address'=>input('address'),
            'f_tel'=>input('tel'),
            'f_job'=>input('job')
        ];
        $model=new \app\index\model\Female;
        $save=$model->saveInfos($data);
        if($save){
            $info['info']=1;
            return $info;
        }else{
            $info['info']=0;
            return $info;
        }

    }

}