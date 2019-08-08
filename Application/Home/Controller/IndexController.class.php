<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function Index(){
        $this->display('Index');
   }
   public function Logincheck(){
       if (IS_AJAX){
           $db=M('Accounts');
           $where['身份证号']=I('username');
           $where['密码']=I('password');
           $result = $db->where($where)->find();
           if(($result)){
               $_SESSION['idcard']=$where['身份证号'];
               $data['lasttime'] = date("Y-m-d H:i:s",time());
               $db->where($where)->save($data);
               $this->ajaxReturn('ok');
           }else{
               $this->ajaxReturn('身份证号或者密码不正确！请核实！');
           }
       }
   }
   public function Loginout()
   {
       session(null);
       $this->redirect('Index/Index');
   }
}