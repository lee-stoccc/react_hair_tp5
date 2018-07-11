<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 20:44
 */

namespace app\index\controller;


use think\Controller;
use app\index\model\HairIndex;
class Hairindexc extends Controller
{
    public function index(){
        header('Access-Control-Allow-Origin:*');
        $index=new HairIndex();
        $con=input('cid');
        $res=$index->index($con);
        $res['lanmu']=json_decode($res['lanmu']);
        if($res){
            echo json_encode($res);
        }else{
            echo json_encode(array('code'=>-1));
        }
    }
}