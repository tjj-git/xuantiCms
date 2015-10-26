<?php
namespace admin\Controller;

use Think\Controller;

import('ORG.Util.Page');

class StudentController extends CommonController
{

    //学生列表
    public function index()
    {

        $class_list = M('class')->select();
        $_form_name = $_GET['name'];
        $_form_number = $_GET['number'];
        $_form_class = $_GET['class_id'];
        $id = $_GET['id'];

        $data_form = array();
        if ($_form_name != null) {
            $data_form['name'] = array('like', '%' . $_form_name . '%');
        }
        if ($_form_number != null) {
            $data_form['studentNumber'] = array('like', '%' . $_form_number . '%');
        }
        if ($_form_class != null) {
            $data_form['class_id'] = $_form_class;
        }
        if ($id != null) {
            $data_form['id'] = $id;
        }
        $ret = $this->page('student', $data_form, 10);
        $this->assign('list', $ret['list']);
        $this->assign('class_list', $class_list);
        $this->assign('page', $ret['page']->show());
        $this->display();
    }

    /* public function index()
     {   $student=M('student');
         $class_list=M('class')->select();
         //get
         $_form_name=$_GET['name'];
         $_form_number=$_GET['number'];
         $_form_class=$_GET['class_id'];
         $id=$_GET['id'];

         $data_form=array();
         if($_form_name !=null){
             $data_form['name']=array('like','%'.$_form_name.'%');
         }
         if($_form_number !=null){
             $data_form['student_number']=array('like','%'.$_form_number.'%');
         }
         if($_form_class !=null){
             $data_form['class_id']=$_form_class;
         }
         if($id !=null){
             $data_form['id']=$id;
         }
         $count_student=$student->where($data_form)->count();
         $page=new \Think\Page($count_student,1);
         //样式
         $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
         $page->setConfig('prev', '上一页');
         $page->setConfig('next', '下一页');
         $page->setConfig('last', '末页');
         $page->setConfig('first', '首页');
         $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
         $page->lastSuffix = false;//最后一页不显示为总页数
         //
         $list=$student->where($data_form)->order('id')->limit($page->firstRow.','.$page->listRows)->select();
         //分页跳转的时候保证查询条件
         foreach($data_form as $key=>$val) {
             $page->parameter[$key]   =   urlencode($val);
         }

        if($id){
             $list=$student->where('id='.$id)->select();
         }else{
             $list=$student->select();
         }
         $this->assign('list',$list);
         $this->assign('class_list',$class_list);
         $this->assign('page',$page->show());
         $this->display();
     }*/

    public function addUI()
    {
        $model_class = M('class');
        $class_list = $model_class->select();
        $this->assign('class_list', $class_list);
        $this->display();
    }

    public function add()
    {
        $model = M('student');
        $model_class = M('class');
        $class_name = $model_class->where('id=' . $_POST['class_id'])->getField('name');
        $_POST['create_date'] = time();
        $_POST['class_name'] = $class_name;
        $rules = array(
            array('name', 'require', '姓名必须！'), //默认情况下用正则进行验证
            array('password', 'require', '密码必须！'), //默认情况下用正则进行验证
        );
        if (!$model->validate($rules)->create()){
            $this->error($model->getError());
        }
        $id = $model->add($_POST);
        if ($id > 0) {
            $student_number = date('Ymd', time()) . $_POST['class_id'] . $id;//创建时间+班级id+学生id
            $model->studentNumber = $student_number;
            $model->where('id=' . $id)->save();
            $this->success('添加成功！', '/xuantiCms/student/index/id/' . $id);
        } else {
            $this->error('添加失败！');
        }

    }

    public function editUI()
    {
        $this->check();
        $model_class = M('class');
        $model_student = M('student');
        $class_list = $model_class->select();
        $id = $_GET['id'];
        if ($id > 0) {
            $data = $model_student->where('id=' . $id)->select();
        } else {
            $this->error('id参数错误！');
        }
        $this->assign('class_list', $class_list);
        $this->assign('data', $data);
        $this->assign('class_id', $data[0]['class_id']);
        $this->assign('sex', $data[0]['sex']);
        //var_dump($data);
        $this->display();
    }

    public function edit()
    {
        $model_class = M('class');
        $model_student = M('student');
        $class_list = $model_class->select();
        $id = $_POST['id'];
        $_POST['create_date'] = time();
        $rules = array(
            array('name', 'require', '姓名必须！'), //默认情况下用正则进行验证
            array('password', 'require', '密码必须！'), //默认情况下用正则进行验证
        );
        if (!$model_student->validate($rules)->create()){
            $this->error($model_student->getError());
        }
        if ($id > 0) {
            $_POST['class_name'] = $model_class->where('id=' . $_POST['class_id'])->getField('name');
            $data = $model_student->where('id=' . $id)->save($_POST);
            if (isset($_SESSION['user']) && $_SESSION['user']['flag'] == 1) {
                $this->success('修改成功！', '/xuantiCms/student/index/id/' . $id);
            }/*elseif(isset($_SESSION['user'])&&$_SESSION['user']['flag']==2){
                $this->success('修改成功！','/xuantiCms/student/editUI/id/'.$id);
            }*/
            elseif (isset($_SESSION['user']) && $_SESSION['user']['flag'] == 3) {
                $this->success('修改成功！', '/xuantiCms/student/editUI/id/' . $id);
            }

        } else {
            $this->error('id参数错误！');
        }

    }

    public function delete()
    {
        $id = $_GET['id'];
        $model = M('student');
        if ($id > 0) {
            $model->where('id=' . $id)->delete();
            $this->success('删除成功！', '/xuantiCms/student/index');

        } else {
            $this->error('id参数错误！');
        }
    }

    public function select_subject()
    {
        $subject_id = $_GET['subject_id'];
        $student_id = $_SESSION['user']['id'];
        if ($subject_id && $student_id) {
            $where['subject_id'] = $subject_id;
            $where['student_id'] = $student_id;
            $s_count = 0;//学生同个学期同种课程的选择数量
            $count = M('student_subject')->where($where)->count();
            if ($count > 0) {
                 $this->error('你已经选了此门课程，请不要重复选择!');
            }
            else{
            //获取本门课程类型的最大选课数
            $subject_type_id = M('subject')->where('id=' . $subject_id)->find();
            $type_max_count = M('type')->where('id=' . $subject_type_id['type_id'])->getField('count');


            $where1['student_id'] = $student_id;
            $s_select = M('student_subject')
                ->table('student_subject s_b')
                ->join('subject s on s_b.subject_id=s.id')
                ->where($where1)
                ->select();//学生选择的课程
            // var_dump($s_select);
            foreach ($s_select as $k => $v) {
                if ($v['term_id'] == $subject_type_id['term_id'] && $subject_type_id['type_id'] == $v['type_id']) {
                    $s_count++;
                }
            }
           // var_dump($s_count);
            if ($s_count >= $type_max_count) {
                $this->error('此类课程你已经选够，请不要再次选择!');
            } else {
                $add_data['subject_id'] = $subject_id;
                $add_data['student_id'] = $student_id;
                $add_data['student_name'] = M('student')->where('id=' . $student_id)->getField('name');
                $add_data['subject_name'] = $subject_type_id['name'];
                $add_data['create_date'] = time();
                $r_id=M('student_subject')->add($add_data);
                 if($r_id>0){
                   //  M('sunject')->where('id='.)->
                   //  M('subject')->where('id='.$subject_id)->setField('selected',);
                     $this->success('恭喜你，选择成功！');
                 }
            }
            }

        }
    }
    public function  my_subject()
    {   $this->check();
        if (isset($_GET['student_id'])) {
            $list = M('subject')
                ->table('subject s')
                ->join('student_subject sb on s.id=sb.subject_id')
                ->join('term term on s.term_id=term.id')
                ->join('type type on s.type_id=type.id')
                ->join('teacher teacher on s.type_id=teacher.id')
                ->where('sb.student_id=' . $_GET['student_id'])
                ->field('s.*,term.name as term_name,type.name as type_name,teacher.name as teacher_name')
                ->select();
            $list=$this->sum_subject($list);//统计选课情况
            $this->assign('list',$list);
            $this->display();
        }
    else{
       $this->error('id参数错误!');
    }
  }
}