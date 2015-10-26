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
<style type="text/css">
    .pages a,.pages span {
        display:inline-block;
        padding:2px 5px;
        margin:0 1px;
        border:1px solid #f0f0f0;
        -webkit-border-radius:3px;
        -moz-border-radius:3px;
        border-radius:3px;
    }
    .pages a,.pages li {
        display:inline-block;
        list-style: none;
        text-decoration:none; color:#58A0D3;
    }
    .pages a.first,.pages a.prev,.pages a.next,.pages a.end{
        margin:0;
    }
    .pages a:hover{
        border-color:#50A8E6;
    }
    .pages span.current{
        background:#50A8E6;
        color:#FFF;
        font-weight:700;
        border-color:#50A8E6;
    }
</style>
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
  <a href="#">课程管理</a> <span class="divider">/</span>
  我的选课
</ul>
   
   <div class="title_right"><strong>我的选课</strong></div>
         <div class="modal-body" style="height: auto;">
            <!-- <table class="table table-bordered">
                 <form action="/xuantiCms/subject/index" method="get" id="form">
                     <tr>
                         <td>课程名称:<input name="name" type="text"/></td>
                         <td>学期:
                             <select name="term_id">
                                 <option value="">==请选择==</option>
                                 <?php if(is_array($term_list)): $i = 0; $__LIST__ = $term_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                         </select></td>
                         <td>课程类型:
                             <select name="type_id">
                                 <option value="">==请选择==</option>
                                 <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                             </select></td>
                         <td>任课老师:
                             <select name="teacher_id">
                                 <option value="">==请选择==</option>
                                 <?php if(is_array($teacher_list)): $i = 0; $__LIST__ = $teacher_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                             </select></td>
                         <td><input type="submit" value="筛选" onclick="test()"/></td>
                     </tr>
                 </form>
             </table>-->
             <table class="table table-bordered">
                 <tr>
                     <th bgcolor="#f1f1f1">id</th>
                     <th bgcolor="#f1f1f1">课程名</th>
                     <th bgcolor="#f1f1f1">课程学期</th>
                     <th bgcolor="#f1f1f1">课程类型</th>
                     <th bgcolor="#f1f1f1">任课老师</th>
                     <th bgcolor="#f1f1f1">上课时间</th>
                     <th bgcolor="#f1f1f1">上课地点</th>
                     <th bgcolor="#f1f1f1">是否显示</th>
                     <th bgcolor="#f1f1f1">截止时间</th>
                     <th bgcolor="#f1f1f1">创建时间</th>
                     <th bgcolor="#f1f1f1">描述</th>
                     <th bgcolor="#f1f1f1">上课人数</th>
                     <th bgcolor="#f1f1f1">已选人数</th>
                     <th bgcolor="#f1f1f1">剩余人数</th>
                     <th bgcolor="#f1f1f1">操作</th>
                 </tr>
                 <tr>
                     <td colspan="14" align="center">
                    <?php if($list == null): ?>无任何选课记录!<?php endif; ?>
                     </td>
                 </tr>
                 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                         <td align="center"><?php echo ($v["id"]); ?></td>
                         <td align="center"><?php echo ($v["name"]); ?></td>
                         <td align="center"><?php echo ($v["term_name"]); ?></td>
                         <td align="center"><?php echo ($v["type_name"]); ?></td>
                         <td align="center"><?php echo ($v["teacher_name"]); ?></td>
                         <td align="center"><?php echo ($v["subject_time"]); ?></td>
                         <td align="center"><?php echo ($v["subject_address"]); ?></td>
                         <td align="center">
                             <?php if($v["show"] == 1): ?>是
                             <?php else: ?>
                                 否<?php endif; ?>
                             </td>
                         <td align="center">
                             <?php if($v["end_time"] != '' ): echo (date('Y-m-d H:i',$v["end_time"])); endif; ?>
                             </td>
                         <td align="center"><?php echo (date('Y-m-d H:i',$v["create_date"])); ?></td>
                         <td align="center" title='<?php echo ($v["desc"]); ?>'><?php echo (mb_substr($v["desc"],0,20,'utf-8')); ?>...</td>
                         <td align="center"><?php echo ($v["max_count"]); ?></td>
                         <td align="center"><?php echo ($v["selected"]); ?></td>
                         <td align="center"><?php echo ($v["no_selected"]); ?></td>
                         <td align="center">
                             <?php if($user['flag']==3): ?>已选<?php endif; ?>
                            <!-- <?php if($user['flag']==1): ?><a href="/xuantiCms/subject/editUI/id/<?php echo ($v["id"]); ?>">编辑</a>
                                 <a href="/xuantiCms/subject/delete/id/<?php echo ($v["id"]); ?>" onclick="javascript:return p_del()">删除</a><?php endif; ?>-->

                         </td>
                     </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              <!--   <tr><td colspan="14" align="center">
                     <div class="pages">
                     <?php echo ($page); ?>
                 </div></td></tr>-->

             </table>
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