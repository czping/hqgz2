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
    /*
     * Accountlist用户账号列表
     */
    public function Accountlist()
    {
        if(IS_AJAX) {
            $limit=I('limit',30);
            $page=(I('page',1)-1)*$limit;
            $dept=I('dept');
            $db=M('accounts');
            $join='INNER JOIN gz_authname ON gz_accounts.权限 = gz_authname.id';
            $join2='INNER JOIN gz_positionname ON gz_accounts.类别 = gz_positionname.id ';
            if($dept!='all'){
                $where['部门名称']=$dept;
            }
            if(!empty(I('username'))){
                $where['姓名']=array('like',I('username').'%');
            }
            if (!empty(I('idcard'))){
                $where['身份证号']=I('idcard');
            }
            if ($dept=='all' && empty(I('username')) && empty(I('idcard'))) {
                $allaccounts=$db->order('部门名称 asc')->limit($page,$limit)->join($join)->join($join2)->select();
                $data['count']=$db->count();
            }else{
                $allaccounts=$db->order('部门名称 asc')->where($where)->limit($page,$limit)->join($join)->join($join2)->select();
                $data['count']=$db->where($where)->count();
            }
            $data['code']=0;
            $data['msg']='';
            $data['data']=$allaccounts;
            $this->ajaxReturn($data);
    }
    }
    public function Edituser(){
        $db=M('accounts');
        $depts=$db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        $this->assign("depts",$depts);
        $this->display('User/User/Edituserform');
    }
    public function Adduser(){
        $db=M('accounts');
        $depts=$db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        $this->assign("depts",$depts);
        $this->display('User/User/Userform');
    }
    public function Addusersubmit(){
        if (IS_AJAX){
            $data['姓名']=I('username');
            $data['部门名称']=I('dept');
            $data['身份证号']=I('idcard');
            $data['密码']=substr($data['身份证号'],-6);
            $data['类别']=I('type');
            $data['权限']=I('auth');
            $db=M('accounts');
            $result= $db->add($data);
            if ($result){
                $this->ajaxReturn('添加成功');
            }else{
                $this->ajaxReturn('添加失败');
            }
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