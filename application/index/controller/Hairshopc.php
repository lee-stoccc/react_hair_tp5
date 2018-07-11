<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 21:37
 */

namespace app\index\controller;


use think\Collection;
use think\Controller;
use app\index\model\Hairshop;

class Hairshopc extends Controller
{
    public function shoplist(){
        header('Access-Control-Allow-Origin:*');
        $con=input('cid');
        $shop=new Hairshop();
        $data=$shop->shoplist($con);
        if($data){
            echo json_encode($data);
        }else{
            echo json_encode(array('code'=>-1));
        }
    }

    public function searchname(){
        header('Access-Control-Allow-Origin:*');
        $con=input('name');
        $shop=new Hairshop();
        $data=$shop->searchshop($con);
        if($data){
            echo json_encode($data);
        }else{
            echo json_encode(array('code'=>1));
        }
    }
}