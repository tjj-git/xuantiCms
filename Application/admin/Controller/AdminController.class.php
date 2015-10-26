<?php
namespace admin\Controller;

use Think\Controller;
use Think\Model\ViewModel;

class AdminController extends CommonController
{
    public function index()
    {
        $this->display();
    }

    public function admin()
    {   $this->check();
        $user = $_SESSION['user'];
        /*if (!isset($_SESSION['user'])) {
            $this->error('请登陆！', '/xuantiCms/admin/login');
        }
        $this->assign('user', $user);*/
        $this->left();
        //var_dump($user);
        $this->display();
    }
    /*输出菜单权限控制*/
    public function left()
    {
        $user = $_SESSION['user'];
        if (!isset($_SESSION['user'])) {
            $this->error('请登陆！', '/xuantiCms/admin/login');
        }
        switch ($user['flag']) {
            //学生
            case 3:
                $left_array = array(
                    '我' => array('信息修改' => '/xuantiCms/student/editUI/id/' . $user['id'], '我的选课' => '/xuantiCms/student/my_subject/student_id/'.$user['id']),
                    '选课' => array('进入选课' => '/xuantiCms/subject/index'),
                );
                $_SESSION['left_array']=$left_array;
                $this->assign('left_array', $left_array);
                break;
            //老师
            case 2:
                $left_array = array(
                    '我' => array('信息修改' => '/xuantiCms/teacher/editUI/id/' . $user['id'], '选课情况' => '/xuantiCms/teacher/my_student_subject/teacher_id/'.$user['id']),
                    '课程管理' => array('课程列表' => '/xuantiCms/subject/index', '添加课程' => '/xuantiCms/subject/addUI'),
                );
                $_SESSION['left_array']=$left_array;
                $this->assign('left_array', $left_array);
                break;
            //管理员
            case 1:
            $left_array = array(
                '班级管理' => array('班级列表' => '/xuantiCms/class/index', '添加班级' => '/xuantiCms/class/addUI'),
                '教师管理' => array('教师列表' => '/xuantiCms/teacher/index', '添加教师' => '/xuantiCms/teacher/addUI'),
                '课程类型管理' => array('类型列表' => '/xuantiCms/type/index', '添加类型' => '/xuantiCms/type/addUI'),
                '学期管理' => array('学期列表' => '/xuantiCms/term/index', '添加学期' => '/xuantiCms/term/addUI'),
                '课程管理' => array('课程列表' => '/xuantiCms/subject/index', '添加课程' => '/xuantiCms/subject/addUI'),
            );
            $_SESSION['left_array']=$left_array;
            $this->assign('left_array', $left_array);
            break;
            default:


        }

        $this->assign('user', $user);
        //var_dump($user);
        $this->display();
    }

    public function login()
    {
        session_destroy();
        //var_dump($_SESSION['user']);
        $this->display();

    }

    public function loginin()
    {

        switch ($_POST['flag']) {
            case 1:
                $this->loginModel('admin', 1, 'username', $_POST);
                break;
            case 2:
                $this->loginModel('teacher', 2, 'teacherNumber', $_POST);
                break;
            case 3:
                $this->loginModel('student', 3, 'studentNumber', $_POST);
                break;
            default:
                $this->error('请选择身份!');
        }

    }

    public function loginModel($model, $flag, $zhanghao, $post)
    {
        $data = array();
        if (isset($post['username'])) {
            $post['username']='"'.$_POST['username'].'"';
            $data = M($model)->where($zhanghao . '=' . $post['username'])->find();
            if ($data == null) {

                $this->error('账号不存在');

            }
        } else {
            $this->error('请输入账号!');

        }
        if (isset($post['password'])) {
            if ($data['password'] == $post['password']) {
                $data['flag'] = $flag;//代表学生角色
                $_SESSION['user'] = $data;
                $this->success('登陆成功！', '/xuantiCms/admin/admin');
            } else {
                $this->error('密码错误');
            }
        } else {
            $this->error('请输入密码!');
        }

    }
}