<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>选课信息管理系统</title>
    <link rel="stylesheet" href="/xuantiCms/Public/cms/css/bootstrap.css"/>
    <link rel="stylesheet" href="/xuantiCms/Public/cms/css/css.css"/>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/jquery1.9.0.min.js"></script>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/sdmenu.js"></script>
    <script type="text/javascript" src="/xuantiCms/Public/cms/js/laydate/laydate.js"></script>

</head>

<body>

<div class="Switch"></div>
<script type="text/javascript">
    $(document).ready(function (e) {
        $(".Switch").click(function () {
            $(".left").toggle();

        });
    });
</script>

<div class="right" id="mainFrame">

    <div class="right_cont">
        <ul class="breadcrumb">当前位置：
            <a href="#">首页</a> <span class="divider">/</span>
            <a href="#">课程管理</a> <span class="divider">/</span>
            课程添加
        </ul>

        <div class="title_right"><strong>课程添加</strong></div>
        <div style="width:900px;margin:auto;">
            <form action="/xuantiCms/subject/add" method="post">
                <table>
                    <tr>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">课程名：</td>
                        <td width="23%"><input type="text" class="span1-1" id="name" name="name"
                                               style="height: 25px;width: 180px;"/></td>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">学期：</td>
                        <td width="23%">
                            <select name="term_id">
                                <?php if(is_array($term_list)): $i = 0; $__LIST__ = $term_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">上课时间：</td>
                        <td width="23%"><input type="text" class="span1-1" id="subject_time" name="subject_time"
                                               style="height: 25px;width: 180px;"/></td>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">课程类型：</td>
                        <td width="23%">
                            <select name="type_id">
                                <?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>

                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">上课地点：</td>
                        <td width="23%"><input type="text" class="span1-1" id="subject_address" name="subject_address"
                                               style="height: 25px;width: 180px;"/></td>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">任课老师：</td>
                        <td width="23%">
                            <select name="teacher_id">
                                <?php if(is_array($teacher_list)): $i = 0; $__LIST__ = $teacher_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1"> 截止时间：</td>
                        <td width="23%"><input type="text" name="end_time" class="laydate-icon span1-1" id="Calendar"
                                               value="2015-08-25"/></td>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1"> 是否显示：</td>
                        <td width="23%">
                            <select name="show" style="width: 20%">
                                <option value="1">是</option>
                                <option value="0">否</option>

                            </select>
                            上课人数：
                            <input name="max_count" style="width: 12%"/>
                        </td>


                    </tr>
                    <tr>
                        <td width="10%" align="right" nowrap="nowrap" bgcolor="#f1f1f1" rowspan="5">课程描述：</td>
                        <td colspan="3" rowspan="5"><textarea name="desc" class="span10" rows="10"
                                                              style="width: 82%"></textarea></td>

                    </tr>

                </table>

                <table class="margin-bottom-20 table  no-border">
                    <tr>
                        <td class="text-center">
                            <input type="submit" value="确定" class="btn btn-info " style="width:80px;"/>
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
    !function () {
        laydate.skin('molv');
        laydate({elem: '#Calendar'});
    }();

</script>


</body>
</html>