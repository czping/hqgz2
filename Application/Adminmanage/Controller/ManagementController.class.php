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

       // $this->display('Index/Index');
    }
    public function Console(){
       $this->display('Home/Homepage2');
    }
    public function AccountManage()
    {
        $this->display('User/User/List');
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
    public function userinfo(){
        $this->display('Set/User/Info');
    }
    public function userpasswd(){
        $this->display('Set/User/Password');
    }

}