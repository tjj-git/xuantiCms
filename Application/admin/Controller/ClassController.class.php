<?php
namespace admin\Controller;
use Think\Controller;
class ClassController extends Controller
{

    //班级列表
    public function index()
    {   $student=M('class');
        $id=$_GET['id'];
        if($id){
            $list=$student->where('id='.$id)->select();
        }else{
            $list=$student->select();
        }
        $this->assign('list',$list);
        $this->display();
    }

    public function addUI()
    {
        $this->display();
    }

    public function add()
    {
        $data = $_POST;
        //$data = getData();
        $rules = array(
            array('name', 'require', '名称必须！'), //默认情况下用正则进行验证
        );
        $data['create_date'] = time();
        $model = M('class');
        if (!$model->validate($rules)->create()){
            $this->error($model->getError());
        }
        $id=$model->add($data);
        $this->assign('id',$id);
        if($id>0){

            $this->success('添加成功！','/xuantiCms/class/index/id/'.$id);
        }else{
            $this->error('添加失败！');
        }

    }
    public function editUI()
    {   $id=$_GET['id'];
        if($id>0){
            $model=M('class');
            $data=$model->where('id='.$id)->select();
            $this->assign('data',$data);
            $this->display();
        }else{
            $this->error('id参数错误！');
        }

    }
    public function edit(){
        $id=$_POST['id'];
        $_POST['create_date']=time();
        $rules = array(
            array('name', 'require', '名称必须！'), //默认情况下用正则进行验证
        );
        $data['create_date'] = time();
        $model = M('class');
        if (!$model->validate($rules)->create()){
            $this->error($model->getError());
        }
        if($id>0){
            $model=M('class');
            $model->where('id='.$id)->save($_POST);
            $this->success('修改成功！','/xuantiCms/class/index/id/'.$id);
        }else{
            $this->error('修改失败！');
        }
    }
    public function delete(){
        $id=$_GET['id'];
        if($id>0){
            $model=M('class');
            $model->where('id='.$id)->delete();
            $this->success('删除成功！','/xuantiCms/class/index');
        }else{
            $this->error('id参数错误！');
        }
    }


}