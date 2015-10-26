<?php
namespace admin\Controller;
use Think\Controller;
import('ORG.Util.Page');
class SubjectController extends CommonController
{

    //列表
    public function index(){
        $this->check();
        $term_list=M('term')->select();
        $type_list=M('type')->select();
        $teacher_list=M('teacher')->select();
        $_form_name=$_GET['name'];
        $_form_type=$_GET['type_id'];
        $_form_term=$_GET['term_id'];
        $_form_teacher=$_GET['teacher_id'];
        $id=$_GET['id'];

        $data_form=array();
        if($_form_name !=null){
            $data_form['subject.name']=array('like','%'.$_form_name.'%');
        }

        if($_form_teacher !=null){
            $data_form['subject.teacher_id']=$_form_teacher;
        }
        if($_form_term !=null){
            $data_form['subject.term_id']=$_form_term;
        }
        if($_form_type !=null){
            $data_form['subject.type_id']=$_form_type;
        }
        if($id !=null){
            $data_form['subject.id']=$id;
        }
        if($_SESSION['user']['flag'] ==3){
            $data_form['subject.show']=1;
        }
        if($_SESSION['user']['flag'] ==3){
            $today=strtotime(date('Y-m-d 00:00:00'));//今天凌晨
            //var_dump(date('Y-m-d H:i:s',$today));
            $data_form['end_time']=array('egt',$today);

        }
        $ret=$this->page_subject('subject',$data_form,10);
        //统计剩余人数和已选人数

        foreach($ret['list'] as $key=>$value){
            $ret['list'][$key]['selected']=M('student_subject')->where('subject_id='.$value['id'])->count();
            $ret['list'][$key]['no_selected']=$value['max_count']-  $ret['list'][$key]['selected'];
        }



        //var_dump($ret['list']);
        $this->assign('list',$ret['list']);
        $this->assign('term_list',$term_list);
        $this->assign('type_list',$type_list);
        $this->assign('teacher_list',$teacher_list);
        $this->assign('page',$ret['page']->show());
        $this->display();
    }

    public function addUI()
    {   $model_term=M('term');
        $model_type=M('type');
        $model_teacher=M('teacher');
        $term_list=$model_term->select();
        $type_list=$model_type->select();
        $teacher_list=$model_teacher->select();
        $this->assign('term_list',$term_list);
        $this->assign('teacher_list',$teacher_list);
        $this->assign('type_list',$type_list);
        $this->display();
    }

    public function add()
    {
        $model=M('subject');
        $_POST['create_date']=time();
        $_POST['end_time']=strtotime($_POST['end_time']);
        $rules = array(
            array('name', 'require', '名称必须！'), //默认情况下用正则进行验证
            array('subject_time', 'require', '上课时间必须！'), //默认情况下用正则进行验证
            array('subject_address', 'require', '上课地点必须！'), //默认情况下用正则进行验证
            array('max_count', 'require', '上课人数必须！'), //默认情况下用正则进行验证
        );
        if (!$model->validate($rules)->create()){
            $this->error($model->getError());
        }
        $id=$model->add($_POST);
        if($id>0){
            $this->success('添加成功！','/xuantiCms/subject/index/id/'.$id);
        }else{
            $this->error('添加失败！');
        }

    }
    public function editUI()
    {
        $model_subject=M('subject');
        $model_term=M('term');
        $model_type=M('type');
        $model_teacher=M('teacher');
        $term_list=$model_term->select();
        $type_list=$model_type->select();
        $teacher_list=$model_teacher->select();

        $id=$_GET['id'];
        if($id>0){
            $data=$model_subject->where('id='.$id)->select();
        }else{
            $this->error('id参数错误！');
        }
        $end_time=date('Y-m-d',$data[0]['end_time']);
        $this->assign('data',$data);
        $this->assign('term_id',$data[0]['term_id']);
        $this->assign('is_show',$data[0]['show']);
        $this->assign('type_id',$data[0]['type_id']);
        $this->assign('teacher_id',$data[0]['teacher_id']);
        $this->assign('end_time',$end_time);
        $this->assign('term_list',$term_list);
        $this->assign('teacher_list',$teacher_list);
        $this->assign('type_list',$type_list);
        $this->display();
    }
    public function edit()
    {
        $model_subject=M('subject');
        $id=$_POST['id'];
        $_POST['create_date']=time();
        $_POST['end_time']=strtotime($_POST['end_time']);
        $rules = array(
            array('name', 'require', '名称必须！'), //默认情况下用正则进行验证
            array('subject_time', 'require', '上课时间必须！'), //默认情况下用正则进行验证
            array('subject_address', 'require', '上课地点必须！'), //默认情况下用正则进行验证
            array('max_count', 'require', '上课人数必须！'), //默认情况下用正则进行验证
        );
        if (!$model_subject->validate($rules)->create()){
            $this->error($model_subject->getError());
        }
        if($id>0){
            $data=$model_subject->where('id='.$id)->save($_POST);
            $this->success('修改成功！','/xuantiCms/subject/index/id/'.$id);

        }else{
            $this->error('id参数错误！');
        }

    }
    public function delete(){
        $id=$_GET['id'];
        $model=M('subject');
        if($id>0){
            $model->where('id='.$id)->delete();
            $this->success('删除成功！','/xuantiCms/subject/index');

        }else{
            $this->error('id参数错误！');
        }
    }
}