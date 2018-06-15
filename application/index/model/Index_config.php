<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 20:34
 */

namespace app\index\model;
use think\Db;

class Index_config {
   public function Index_confg($mini_id){
       $Index_config=new DB();
       $get_data=$Index_config::table('index')->field('*')->where('mini_id',$mini_id)->find();
       return $get_data;
   }
}