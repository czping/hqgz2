<?php
namespace Adminmanage\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function Index(){
        $this->display('Index/Index');
    }
    public function Logincheck(){
        if (IS_AJAX){
            $db=M('Accounts');
            $where['身份证号']=I('username');
            $where['密码']=I('password');
            $where['权限']=1;
            $result = $db->where($where)->find();
            if(($result)){
                //$this->success('欢迎您登陆', '/Detail/Index',3);
                $_SESSION['idcard']=$where['身份证号'];
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