<?php
/**
 * Created by PhpStorm.
 * User: zhangping
 * Date: 2019-07-17
 * Time: 12:14
 */

namespace Home\Controller;
use Think\Controller;

class DetailController  extends Controller

{
    protected function _initialize()
    {
        // 登录检测
        if (!is_login()) {
            //还没登录跳转到登录页面
            $this->redirect('Home/Index/Index');
        }
    }
    public function Index(){

        $where['身份证号']=$_SESSION['idcard'];
        $db=M('Management');  //对已有数据进行筛选找出有日期
        $result_dates=$db->group('年份,月份')->order('年份 desc,月份 desc')->field('年份,月份')->select();
        if (IS_POST){
            $get_select_dates =  I('post.dates',201913);
            $where['年份']=   substr($get_select_dates,0,4);
            $where['月份']=   substr($get_select_dates,-2);
        }else{    
            $where['年份']=$result_dates[0]['年份'];
            $where['月份']=$result_dates[0]['月份'];
        }

        $result_value = $db->where($where)->find();

        if ($result_value) { //管理岗里找记录
            $result_filed=$db->getDbFields();
        }else{
            $db2=M('Workers');//到工勤库里找
            $result_value = $db2->where($where)->find();
            $result_filed=$db2->getDbFields();
        }



        $this->assign('result_dates',$result_dates);
        $this->assign('result_field',$result_filed);
        $this->assign('result_value',$result_value);
        $this->display('Index');
    }

}