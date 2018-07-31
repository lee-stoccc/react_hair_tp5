<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/31
 * Time: 18:08
 */

namespace app\index\controller;

use think\Controller;
use app\index\model\Hairdesigner;
class Hairdesignerc extends Controller
{

    // 查询某一店铺的设计师资料
    public function designer(){
        $cid=input('cid');
        $shopid=input('shopid');
        header('Access-Control-Allow-Origin:*');
        $designer=new Hairdesigner();
        $designerdetail=$designer->designer($cid,$shopid);
        if($designerdetail){
            return $designerdetail;
        }else{
            return array('msg'=>'查无数据或查询错误c');
        }
    }
}