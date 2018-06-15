<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 17:18
 */

namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;

class User extends Controller
{
    public function get_user($u,$p){
        header('Access-Control-Allow-Origin:*');
        $connect = new Db();
        $data =$connect::table('user')->field('username,pass,uid')->where('username','=',$u)->select();
        if(!empty($data)){
            if($p==$data[0]['pass']){
                Session::set($u,$data[0]['uid']);
                return '登录成功';
            }else{
                return '密码错误';
            }
        }else{
            return '查无此账号';
        }
    }
}