<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选课信息管理系统</title>
<link rel="stylesheet" href="/xuantiCms/Public/cms/css/bootstrap.css" />
<link rel="stylesheet" href="/xuantiCms/Public/cms/css/css.css" />
<script type="text/javascript" src="/xuantiCms/Public/cms/js/jquery1.9.0.min.js"></script>
<script type="text/javascript" src="/xuantiCms/Public/cms/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/xuantiCms/Public/cms/js/sdmenu.js"></script>
<script type="text/javascript" src="/xuantiCms/Public/cms/js/laydate/laydate.js"></script>

</head>

<body>

     <div class="Switch"></div>
     <script type="text/javascript">
	$(document).ready(function(e) {
    $(".Switch").click(function(){
	$(".left").toggle();
	 
		});
});
</script>

     <div class="right"  id="mainFrame">
     
     <div class="right_cont">
<ul class="breadcrumb">当前位置：
  <a href="#">首页</a> <span class="divider">/</span>
  <a href="#">学生管理</a> <span class="divider">/</span>
  学生添加
</ul>
   
   <div class="title_right"><strong>学生添加</strong></div>
<div style="width:900px;margin:auto;">
    <form action="/xuantiCms/teacher/edit" method="post">
        <input type="hidden" name="id" value="<?php echo ($data[0]["id"]); ?>"/>
       <table class="table table-bordered">
         <tr>
               <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">学号：</td>
               <td width="23%"><?php echo ($data[0]["teachernumber"]); ?></td>
             <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">姓名：</td>
             <td width="23%"><input type="text"  class="span1-1" id="name" name="name" value="<?php echo ($data[0]["name"]); ?>" style="height: 25px;width: 180px;"/></td>
             <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">性别：</td>
             <td width="23%" >
                 <input type="radio"  class="span1-1"  <?php if($sex == '男'): ?>checked<?php endif; ?> name="sex" value="男"/>男
                 <input type="radio"  class="span1-1"  <?php if($sex == '女'): ?>checked<?php endif; ?> name="sex" value="女"/>女

             </td>
             </tr>
           <tr>
             <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">登陆密码：</td>
             <td width="23%" height="30%"><input type="text"  class="span1-1" id="password" name="password" value="<?php echo ($data[0]["password"]); ?>" style="height: 25px;width: 180px;"/></td>
             <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">联系电话：</td>
             <td width="23%"><input type="text"  class="span1-1" id="tel" name="tel" value="<?php echo ($data[0]["tel"]); ?>" style="height: 25px;width: 180px;"/></td>
               <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">备注：</td>
               <td width="23%"><input type="text"  class="span1-1" id="desc" name="desc" value="<?php echo ($data[0]["desc"]); ?>" style="height: 25px;width: 180px;"/></td>

           </tr>

       </table>
        <table  class="margin-bottom-20 table  no-border" >
            <tr>
                <td class="text-center">
                    <input type="submit" value="确定" class="btn btn-info " style="width:80px;" />
                </td>
            </tr>
        </table>
</form>
   </div>  
     
 </div>     
     </div>
    </div>
    
<!-- 底部 -->
<div id="footer">版权所有：晶科客流 &copy; 2015&nbsp;&nbsp;&nbsp;&nbsp;服务热线：0371-88888888</div>
    
    

 <script>
!function(){
laydate.skin('molv');
laydate({elem: '#Calendar'});
}();
 
</script>



 
</body>
</html>