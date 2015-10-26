<?php
namespace admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      $n=1;
      $line=array();
      while($n<=3){
      $line['keyword'][$n]='qqq1';
      $n++;
      }
      var_dump($line);
       $this->assign('line',$line['keyword']);
       $this->display();
    }
 public function detail(){
    $id=$_GET['id'];
    $data=array('activit_1_1_1');
    
    
 	echo $id;
    }
  public function add(){
      echo "helloo admin add！";
    }
 public function addUI(){
    //  $this->show('addUI.html');
        $this->hello='hello';
        $this->name='tjj';
        //$this->display('addUI');
         $this->display();
    }
    public function db(){
    $Data=M('users');
    $this->data=$Data->select();
    $this->display();
    
    }
}