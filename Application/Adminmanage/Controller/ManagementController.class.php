<?php
namespace Adminmanage\Controller;
use Think\Controller;
class ManagementController extends Controller {
    protected function _initialize()
    {
        // 登录检测
        if (!is_login()) {
            //还没登录跳转到登录页面
            $this->redirect('Adminmanage/Index/Index');
        }
    }
    public function Index(){

        $this->display('Home/Index');
    }
    public function Console(){
       $this->display('Home/Homepage2');
    }
    public function AccountManage()
    {
        $db=M('accounts');
        $depts=$db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        $this->assign("depts",$depts);
        $this->display('User/User/List');
    }
    public function Accountlist()
    {
        if(IS_AJAX) {
            $db=M('accounts');
            $allaccounts=$db->order('部门名称 asc')->select();
            $data['code']=0;
            $data['msg']='';
            $data['count']=$db->count();
            $data['data']=$allaccounts;
            $this->ajaxReturn($data);
    }
    }
    public function Query1()
    {
        $this->display('Home/Query');
    }
    public function Query2()
    {
        $this->display('Home/Query2');
    }
    public function Import(){
        $this->display('Home/Import');
    }
    public function Userinfo(){
        $this->display('Set/User/Info');
    }
    public function Userpasswd(){
        $this->display('Set/User/Password');
    }

}