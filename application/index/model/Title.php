<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Title extends Model{
    protected $connection=[
        'type'=>'mysql',
        'hostname'=>'127.0.0.1',
        'database'=>'demo',
        'username'=>'root',
        'password'=>'123',
        'hostport'=>'3306',
    ];
    // 查询所有数据
    public function select_all(){
        $title= new Db;
        $data=$title::table('title')->select();
        return json_encode($data);
    }
    //根据 id 查询单条数据
    public function select_sigle($id){
        $title =new Db;
        $data=$title::table('title')->where('id','=',$id)->find();
        return json_encode($data);
    }
    //客户端提交数据，insect 入数据库,$data 数组的变量名必须与数据库字段名保持一致
    public function inset_goods($title,$price,$address,$person,$persons,$slider,
                                $switchs,$radioGroup,$checkbox){
        $data=['address'=>$address,'price'=>$price,'dis'=>$address,'person'=>$person,'persons'=>$persons,'title'=>$title];
        $goods = new Db;
        $res=$goods::table('title')->insert($data);
        return json_encode($res);
    }
}