<?php

namespace Adminmanage\Controller;

use Think\Controller;

class ManagementController extends Controller
{
    protected function _initialize()
    {
        // 登录检测
        if (!is_login()) {
            //还没登录跳转到登录页面
            $this->redirect('Adminmanage/Index/Index');
        }
    }

    public function Index()
    {

        $this->display('Home/Index');
    }

    public function Console()
    {
        $this->display('Home/Homepage2');
    }

    public function AccountManage()
    {
        $db = M('accounts');
        $depts = $db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        $this->assign("depts", $depts);
        $this->display('User/User/List');
    }

    /*
     * Accountlist用户账号列表
     */
    public function Accountlist()
    {
        if (IS_AJAX) {
            $limit = I('limit', 30);
            $page = (I('page', 1) - 1) * $limit;
            $dept = I('dept');
            $db = M('accounts');
            $join = 'INNER JOIN gz_authname ON gz_accounts.权限 = gz_authname.id';
            $join2 = 'INNER JOIN gz_positionname ON gz_accounts.类别 = gz_positionname.id ';
            if ($dept != 'all') {
                $where['部门名称'] = $dept;
            }
            if (!empty(I('username'))) {
                $where['姓名'] = array('like', I('username') . '%');
            }
            if (!empty(I('idcard'))) {
                $where['身份证号'] = I('idcard');
            }
            if ($dept == 'all' && empty(I('username')) && empty(I('idcard'))) {
                $allaccounts = $db->order('部门名称 asc')->limit($page, $limit)->join($join)->join($join2)->select();
                $data['count'] = $db->count();
            } else {
                $allaccounts = $db->order('部门名称 asc')->where($where)->limit($page, $limit)->join($join)->join($join2)->select();
                $data['count'] = $db->where($where)->count();
            }
            $data['code'] = 0;
            $data['msg'] = '';
            $data['data'] = $allaccounts;
            $this->ajaxReturn($data);
        }
    }

    public function Edituser()
    {
        $db = M('accounts');
        $depts = $db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        $this->assign("depts", $depts);
        $this->display('User/User/Edituserform');
    }

    public function Adduser()
    {
        $db = M('accounts');
        $depts = $db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        $this->assign("depts", $depts);
        $this->display('User/User/Userform');
    }

    public function Addusersubmit()
    {
        if (IS_AJAX) {
            $data['姓名'] = I('username');
            $data['部门名称'] = I('dept');
            $data['身份证号'] = I('idcard');
            $data['密码'] = substr($data['身份证号'], -6);
            $data['类别'] = I('type');
            $data['权限'] = I('auth');
            $db = M('accounts');
            $result = $db->add($data);
            if ($result) {
                $this->ajaxReturn('添加成功');
            } else {
                $this->ajaxReturn('添加失败');
            }
        }
    }

    /**
     * 管理岗薪资查询
     */
    public function Query1()
    {
        //获取部门数据
        $db = M('accounts');
        $depts = $db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        //对已有数据进行筛选找出有日期
        $db2 = M('Management');
        $result_dates = $db2->group('年份,月份')->order('年份 desc,月份 desc')->field('年份,月份')->select();
        $this->assign('result_dates', $result_dates);
        $this->assign("depts", $depts);
        $this->display('Home/Query');
    }
    /*
     * 管理岗位的薪资查询
     */
    public function Managementlist()
    {
        if (IS_AJAX) {
            $limit = I('limit', 30);
            $page = (I('page', 1) - 1) * $limit;
            $dept = I('dept');
            $db = M('Management');
            if ($dept != 'all') {
                $where['部门名称'] = $dept;
            }
            if (!empty(I('username'))) {
                $where['姓名'] = array('like', I('username') . '%');
            }
            if (!empty(I('dates'))) {
                $where['年份'] = substr(I('dates','201907'), 0, 4);
                $where['月份'] = substr(I('dates','201907'), -2);
            }else{
                $where['年份'] = date('Y');
            }


            $allaccounts = $db->order('部门名称 asc')->where($where)->limit($page, $limit)->order('月份 desc')->select();
            $data['count'] = $db->where($where)->count();

            $data['code'] = 0;
            $data['msg'] = '';
            $data['data'] = $allaccounts;
            $this->ajaxReturn($data);
        }
    }

    /*
    * 工勤岗工资查询
    */
    public function Query2()
    {
        //获取部门数据
        $db = M('accounts');
        $depts = $db->group('部门名称')->order('部门名称 asc')->field('部门名称')->select();
        //对已有数据进行筛选找出有日期
        $db2 = M('Workers');
        $result_dates = $db2->group('年份,月份')->order('年份 desc,月份 desc')->field('年份,月份')->select();
        $this->assign('result_dates', $result_dates);
        $this->assign("depts", $depts);
        $this->display('Home/Query2');

    }
    /*
    * 工勤岗的薪资查询
    */
    public function Workerslist()
    {
        if (IS_AJAX) {
            $limit = I('limit', 30);
            $page = (I('page', 1) - 1) * $limit;
            $dept = I('dept');
            $db = M('Workers');
            if ($dept != 'all') {
                $where['部门名称'] = $dept;
            }
            if (!empty(I('username'))) {
                $where['姓名'] = array('like', I('username') . '%');
            }
            if (!empty(I('dates'))) {
                $where['年份'] = substr(I('dates','201907'), 0, 4);
                $where['月份'] = substr(I('dates','201907'), -2);
            }else{
                $where['年份'] = date('Y');
            }


            $allaccounts = $db->order('部门名称 asc')->where($where)->limit($page, $limit)->order('月份 desc')->select();
            $data['count'] = $db->where($where)->count();

            $data['code'] = 0;
            $data['msg'] = '';
            $data['data'] = $allaccounts;
            $this->ajaxReturn($data);
        }
    }
    public function Import()
    {
        $this->display('Home/Import');
    }

    public function Userinfo()
    {
        $this->display('Set/User/Info');
    }

    public function Userpasswd()
    {
        $this->display('Set/User/Password');
    }
    public function userdetail(){
        $db=M('Management');
        $where['身份证号']=I('get.idcard');
        $where['年份'] =  I('get.year');
        $where['月份'] =  I('get.month');

        $result_value = $db->where($where)->find();

        if ($result_value) { //管理岗里找记录
            $result_filed=$db->getDbFields();
        }else{
            $db2=M('Workers');//到工勤库里找
            $result_value = $db2->where($where)->find();
            $result_filed=$db2->getDbFields(); }
        $this->assign('result_dates',$result_dates);
        $this->assign('result_field',$result_filed);
        $this->assign('result_value',$result_value);
        $this->display('Home/Userdetail');
    }
}