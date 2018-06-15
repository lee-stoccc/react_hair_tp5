<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Title;   // 使用model 的 Title 类
class Test extends Controller{
    //直接操作数据库
    public function index(){
        header('Access-Control-Allow-Origin:http://192.168.2.120:8081');
        $B=new Db;
        $bb=$B::table('title')->select();
        return json_encode($bb);
    }
    //根据前端传过来的 ID 查询响应数据
    public function search($id){
        header('Access-Control-Allow-Origin:*');
        $B=new Db;
        $bb=$B::table('title')->where('id','=',$id)->find();
        return json_encode($bb);
    }
    //使用 model 的方法，在模型中操作数据库，在控制器中实例化模型，再调用模型的函数
    public function use_model(){
        $use = new Title();   //第一种方法，在 use 引用
//      $use = new \app\index\model\Title;    //第二种方法，直接new + 命名空间
        $data = $use->select_all();    // 实例化出来的use 调用 Title 类的 title() 方法
        return $data;    //将数据返还
    }
    //单条数据查询 ， 有参数的传入，进行选择查询
    public function select_sigle($id){
        header('Access-Control-Allow-Origin:*');
        $D=new Title();
        $data=$D->select_sigle($id);
        return $data;
    }

    public function insect_goos($title,$price,$address,$person,$persons,$slider,$switchs,$radioGroup,$checkbox){
        $goods=new Title();
        $res=$goods->inset_goods($title,$price,$address,$person,$persons,$slider,$switchs,$radioGroup,$checkbox);
        return $res;
    }
}