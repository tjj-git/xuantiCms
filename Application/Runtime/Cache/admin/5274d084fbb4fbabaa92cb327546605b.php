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

<div class="left">

    <script type="text/javascript">
        var myMenu;
        window.onload = function () {
            myMenu = new SDMenu("my_menu");
            myMenu.init();
        };
    </script>
    <div id="my_menu" class="sdmenu">
       <!--菜单权限控制输出-->
        <?php
 $left_array=$_SESSION['left_array']; foreach($left_array as $key =>$value){ echo '
        <div>'; echo '<span>'.$key.'</span>'; foreach($value as $k =>$val){ echo ' <a href='.$val.' target=mainFrame>'.$k.'</a>'; } echo '
        </div>
        '; } ?>
    </div>
</div>
<script>
    !function () {
        laydate.skin('molv');
        laydate({elem: '#Calendar'});
    }();

</script>


</body>
</html>