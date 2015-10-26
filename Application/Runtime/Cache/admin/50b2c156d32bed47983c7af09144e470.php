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
  <a href="#">学期管理</a> <span class="divider">/</span>
  学期编辑
</ul>
   
   <div class="title_right"><strong>学期编辑</strong></div>
<div style="width:900px;margin:auto;">
    <form action="/xuantiCms/term/edit" method="post">
        <input name="id" value="<?php echo ($data[0]["id"]); ?>" type="hidden"/>
        <table class="table table-bordered" >
            <tr>
                <td width="12%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">名称：</td>
                <td width="38%"><input type="text" name="name" id="input" class="span1-1"  value="<?php echo ($data[0]["name"]); ?>"/></td>
            </tr>
            <tr>
                <td align="right" nowrap="nowrap" bgcolor="#f1f1f1">描述：</td>
                <td colspan="3"><textarea name="desc" id="input9" class="span10"><?php echo ($data[0]["desc"]); ?></textarea></td>
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