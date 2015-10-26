<?php
namespace admin\Controller;
use Think\Controller;
import('ORG.Util.Page');
class TeacherController extends CommonController
{

    //教师列表
    public function index(){

        $_form_name=$_GET['name'];
        $_form_number=$_GET['number'];
        $id=$_GET['id'];

        $data_form=array();
        if($_form_name !=null){
            $data_form['name']=array('like','%'.$_form_name.'%');
        }
        if($_form_number !=null){
            $data_form['teacherNumber']=array('like','%'.$_form_number.'%');
        }
        if($id !=null){
            $data_form['id']=$id;
        }
        $ret=$this->page('teacher',$data_form,10);
        $this->assign('list',$ret['list']);
        $this->assign('page',$ret['page']->show());
        $this->display();
    }
       public function addUI()
    {
        $this->display();
    }

    public function add()
    {
        $model=M('teacher');
        $_POST['create_date']=time();
        $rules = array(
            array('name', 'require', '姓名必须！'), //默认情况下用正则进行验证
            array('password', 'require', '密码必须！'), //默认情况下用正则进行验证
        );
        if (!$model->validate($rules)->create()){
            $this->error($model->getError());
        }
        $id=$model->add($_POST);
        if($id>0){
            $teacher_number=date('Ymd',time()).$id;//创建时间+教师id
            $model->teacherNumber=$teacher_number;
            $model->where('id='.$id)->save();
            $this->success('添加成功！','/xuantiCms/teacher/index/id/'.$id);
        }else{
            $this->error('添加失败！');
        }

    }
    public function editUI()
    {   $this->check();
        $model_teacher=M('teacher');
        $id=$_GET['id'];
        if($id>0){
            $data=$model_teacher->where('id='.$id)->select();
        }else{
            $this->error('id参数错误！');
        }
        $this->assign('data',$data);
        $this->assign('sex',$data[0]['sex']);
        $this->display();
    }
    public function edit()
    {   $this->check();
        $model=M('teacher');
        $rules = array(
            array('name', 'require', '姓名必须！'), //默认情况下用正则进行验证
            array('password', 'require', '密码必须！'), //默认情况下用正则进行验证
        );
        if (!$model->validate($rules)->create()){
            $this->error($model->getError());
        }
        $id=$_POST['id'];
        $_POST['create_date']=time();
        if($id>0){
            $data=$model->where('id='.$id)->save($_POST);

            if (isset($_SESSION['user']) && $_SESSION['user']['flag'] == 1) {
                $this->success('修改成功！', '/xuantiCms/teacher/index/id/' . $id);
            }
            elseif (isset($_SESSION['user']) && $_SESSION['user']['flag'] == 2) {
                $this->success('修改成功！','/xuantiCms/teacher/editUI/id/'.$id);
            }
        }else{
            $this->error('id参数错误！');
        }

    }
    public function delete(){
        $id=$_GET['id'];
        $model=M('teacher');
        if($id>0){
            $model->where('id='.$id)->delete();
            $this->success('删除成功！','/xuantiCms/teacher/index');

        }else{
            $this->error('id参数错误！');
        }
    }
    function my_student_subject(){
        if(isset($_GET['teacher_id'])) {
            $list = M('subject')
                ->table('subject subject')
            //    ->join('left join student_subject sb on sb.subject_id=subject.id')
                ->join('term term on subject.term_id=term.id')
                ->join('type type on subject.type_id=type.id')
                ->join('teacher teacher on subject.teacher_id=teacher.id')
                ->where('subject.teacher_id=' . $_GET['teacher_id'])
                ->field('subject.*,term.name as term_name,type.name as type_name,teacher.name as teacher_name')
                ->order('subject.id')
              //  ->group('');
                ->select();
            // var_dump(M()->getLastSql());
            $list = $this->sum_subject($list);
            foreach($list as $k=>$v){
                if($v['id']){
                    $student_list=$this->student_list($v['id']);
                    $list[$k]['student_list']=$student_list;
                   // $this->assign('student_list', $student_list);
                }
            }
            //var_dump($list);
            $this->assign('list', $list);
        }
        $this->display();
    }
    public  function  student_list($subject_id){

        if($subject_id){
            $student_list= M('student_subject')
            ->table('student_subject sb')
            ->join('student student on student.id=sb.student_id')
            ->where('sb.subject_id='.$subject_id)
            ->field('sb.*,student.name as student_name,student.studentNumber as student_number,student.class_name class_name')
            ->order('student.class_id')->select();
        }
       return $student_list;

    }
    public  function  delete_subject(){
     if(isset($_GET['student_id'])&&isset($_GET['subject_id'])){
         $where['student_id']=$_GET['student_id'];
         $where['subject_id']=$_GET['subject_id'];
         $ret=M('student_subject')->where($where)->delete();
         if($ret){
             $this->success('删除成功！');
         }else{
             $this->error('删除失败！');
         }
     }  else{
         $this->error('参数错误！');
     }
    }
}