<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>晶科物流管理系统</title>
    <link rel="stylesheet" href="/xuantiCms/Public/cms/css/bootstrap.css"/>
    <link rel="stylesheet" href="/xuantiCms/Public/cms/css/css.css"/>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/jquery1.9.0.min.js"></script>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/sdmenu.js"></script>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/laydate/laydate.js"></script>

</head>

<body>
<div class="header">
    <div class="logo"><img src="/xuantiCms/Public/cms/img/logo.png"/></div>

    <div class="header-right">
        <i class="icon-question-sign icon-white"></i> <a href="#">帮助</a> <i class="icon-off icon-white"></i> <a
            href="login" role="button" target="_parent">注销</a> <i class="icon-user icon-white"></i> <a href="#"><?php
 if($_SESSION['user']['flag']==1){ echo '管理员:'.$_SESSION['user']['username']; } if($_SESSION['user']['flag']==2){ echo '老师:'.$_SESSION['user']['name']; } if($_SESSION['user']['flag']==3){ echo '学生:'.$_SESSION['user']['name']; } ?></a> <!--<i class="icon-envelope icon-white"></i> <a href="#">发送短信</a>-->
        <!-- <div id="modal-container-973558" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:300px; margin-left:-150px; top:30%">
         &lt;!&ndash;<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">
						注销系统
					</h3>
				</div>
				<div class="modal-body">
					<p>
						您确定要注销退出系统吗？
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> <a class="btn btn-primary" style="line-height:20px;" href="登录.html" >确定退出</a>
				</div>
			</div>&ndash;&gt;
				</div>-->
    </div>
    <!-- 顶部 -->


    <script>
        !function () {
            laydate.skin('molv');
            laydate({elem: '#Calendar'});
        }();

    </script>


</body>
</html>