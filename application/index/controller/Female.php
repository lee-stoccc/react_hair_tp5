<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 6:48
 */

namespace app\index\controller;
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
            return json_encode($getDatas);
        }else{
            $getDatas['info']=0;
            return json_encode($getDatas);
        }
    }
}