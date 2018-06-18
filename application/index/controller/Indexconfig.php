<?php
namespace app\index\controller;
use think\Controller;

class Indexconfig extends Controller{

    public function get_index_config(){
        header('Access-Control-Allow-Origin:*');
        $get_db=new \app\index\model\Index_config;
        $data=$get_db->Index_confg(input('mini_id'));
        if($data){
            $data['info']=1;
            return $data;
        }else{
            $data['info']=0;
            return $data;
        }
    }
}