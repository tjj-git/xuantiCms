<?php
namespace admin\Controller;
use Think\Controller;
import('ORG.Util.Page');
class CommonController extends Controller
{

    //单表分页列表查询模型
    public function page($model_name,$data,$pageCount=10)
    {   $model=M($model_name);
        $condition=array();
        foreach($data as $key=>$val){
            if($val){
                $condition[$key]=$val;
            }
        }
        $count_model=$model->where($condition)->count();
        $page=new \Think\Page($count_model,$pageCount);
        //样式
        $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        //
        $list=$model->where($condition)->order('id')->limit($page->firstRow.','.$page->listRows)->select();
        //分页跳转的时候保证查询条件
        foreach($condition as $key=>$val) {
            $page->parameter[$key]   =   urlencode($val);
        }
        $ret['list']=$list;
        $ret['page']=$page;
        return $ret;
    }
    //单表分页列表查询模型
    public function page_subject($model_name,$data,$pageCount=10)
    {   $model=M($model_name);
        $condition=array();
        foreach($data as $key=>$val){
            if($val){
                $condition[$key]=$val;
            }
        }
        $count_model=$model->table($model->getTableName())
            ->join('term  on subject.term_id=term.id')
            ->join('type  on subject.type_id=type.id')
            ->join('teacher  on subject.teacher_id=teacher.id')
            ->where($condition)->count();
        $page=new \Think\Page($count_model,$pageCount);
        //样式
        $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        //
        $list=$model->table($model->getTableName())
            ->join('term  on subject.term_id=term.id')
            ->join('type  on subject.type_id=type.id')
            ->join('teacher  on subject.teacher_id=teacher.id')
            ->where($condition)->order('subject.id')->limit($page->firstRow.','.$page->listRows)
            ->field('subject.*,term.name as term_name,type.name as type_name,teacher.name as teacher_name')
            ->select();
        //分页跳转的时候保证查询条件
        foreach($condition as $key=>$val) {
            $page->parameter[$key]   =   urlencode($val);
        }
        $ret['list']=$list;
        $ret['page']=$page;
        return $ret;
    }
    public function check()
    {   //var_dump($_SESSION['user']);
        //ini_set('session.gc_maxlifetime', 3600); //设置时间
       $time= ini_get('session.gc_maxlifetime');//得到ini中设定值
        //var_dump($time);
        if (!isset($_SESSION['user'])) {
            $this->error('请登陆！','/xuantiCms/admin/login');
        } else {
            $this->assign('user', $_SESSION['user']);
        }
    }
    //统计剩余人数和已选人数
   public function  sum_subject($list){
       foreach($list as $key=>$value){
         $list[$key]['selected']=M('student_subject')->where('subject_id='.$value['id'])->count();
         $list[$key]['no_selected']=$value['max_count']-  $list[$key]['selected'];
       }
       return $list;
   }

}