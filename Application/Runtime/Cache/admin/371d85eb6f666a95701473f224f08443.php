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
  学期列表
</ul>
   
   <div class="title_right"><strong>学期列表</strong></div>
<div class="modal-body">
    <table class="table table-bordered">
        <tr>
            <th bgcolor="#f1f1f1">id</th>
            <th bgcolor="#f1f1f1">名称</th>
            <th bgcolor="#f1f1f1">描述</th>
            <th bgcolor="#f1f1f1">创建时间</th>
            <th bgcolor="#f1f1f1">操作</th>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
            <td align="center"><?php echo ($v["id"]); ?></td>
            <td align="center"><?php echo ($v["name"]); ?></td>
            <td align="center"><?php echo ($v["desc"]); ?></td>
            <td align="center"><?php echo (date('Y-m-d H:i',$v["create_date"])); ?></td>
                <td align="center">
                    <a href="/xuantiCms/term/editUI/id/<?php echo ($v["id"]); ?>">编辑</a>
                    <a href="/xuantiCms/term/delete/id/<?php echo ($v["id"]); ?>" onclick="javascript:return p_del()">删除</a>
                </td>
           </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </table>

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
function p_del() {
    var msg = "您真的确定要删除吗？请确认！";
    if (confirm(msg)==true){
        return true;
    }else{
        return false;
    }
}

 </script>



 
</body>
</html>