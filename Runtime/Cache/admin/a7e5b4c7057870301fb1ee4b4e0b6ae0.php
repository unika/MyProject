<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>商城后台管理系统</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script src="__PUBLIC__/Js/jquery.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/my.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/jquery-ui.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/jquery.artDialog.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/artDialog/artDialog.plugins.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/Js/editor/kindeditor.js" type="text/javascript"></script>
		<link href="__PUBLIC__/Js/artDialog/skins/default.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/Js/jquery-ui.css" type="text/css" rel="stylesheet" />
		<script src="__PUBLIC__/Js/jquery-ui.js" type="text/javascript"></script>	
	</head>


<script>
    $(document).ready(function() {
        //增加活动
        var editor;
        $("#add").click(function() {
            var mydialog = $.dialog({
                initialize : function() {
                    $(".hidden").attr("style", "display:none");
                    editor = KindEditor.create('#content');
                },
                title : "添加活动模板",
                content : template,
                lock : true,
                button : [{
                    focus : true,
                    value : "上传模板图片",
                    callback : function() {
                        var second = $.dialog({
                            id : "upload",
                            title : "选择模板图片",
                            content : uploadimage("__URL__/uploadTofile"),
                            okValue : "上传",
                            ok : function() {
                                $("#image").submit();
                                return false;
                            },
                        })
                        return false;
                    }
                }, {
                    value : "提交",
                    callback : function() {
                        $.post("__URL__/addTemplate", $("#template").serialize(), function(data) {
                            if (data.status == 1) {
                                var html = new String();
                                html = '<tr>';
                                html += '<td>' + data.data.Id + '</td>';
                                html += '<td><img style="width:120px;height: 120px;" src="/Upload/Discount/' + data.data.Image + '"></td>';
                                html += '<td>' + data.data.Name + '</td>';
                                html += '<td>' + data.data.Id + '</td>';
                                html += '<td>' + data.data.Designer + '</td>';
                                html += '<td><a aid="' + data.data.Id + '" class="view" href="javascript:void(0)">预览</a> | <a aid="' + data.data.Id + '" class="edit" href="javascript:void(0)">编辑 </a> | <a aid="' + data.data.Id + '" class="del" href="javascript:void(0)">删除</a></td>';
                                html += '</tr>';
                                $("#from1").find("tr:first").after(html);
                            } else {
                                $.alert(data.info);
                            }

                        }, 'json');
                    }
                }, {
                    value : "取消",
                    callback : function() {
                        this.content()
                    }
                }]
            });
        })
        $(".del").click(function() {
            var obj = $(this);
            $.confirm('删除模板记录的同时,模板文件将一同被删除', function() {
                $.post("__URL__/delTemplate", {
                    "Id" : obj.attr("aid")
                }, function(data) {
                    $.alert(data.info);
                }, 'json')
                obj.parents("tr").remove();
            }, function() {
                this.close();
            });
        });
        $(".edit").click(function() {
            $.post("__URL__/editTemplate", {
                "Id" : $(this).attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    $.dialog({
                        initialize : function() {
                            $("#Name").val(data.data.Name);
                            $("#img").attr("src", "/Upload/Discount/" + data.data.Image);
                            $("#Designer").val(data.data.Designer);
                            $("#Content").val(data.data.Html);
                            $("#Name").after("<input type='hidden' id='Id' name='Id' value='" + data.data.Id + "'/>");
                        },
                        lock : true,
                        title : "更新活动模板",
                        content : template,
                        okValue : "更新",
                        ok : function() {
                            $.post("__URL__/updateTemplate", $("#template").serialize(), function(data) {
                                $.alert(data.info);
                            }, 'json');
                        },
                        cancelValue : "关闭",
                        cancel : function() {
                            this.close();
                        }
                    })

                } else {
                    $.alert(data.info);
                }

            }, 'json')

        });
        //模板预浏功能
        $(".view").click(function() {
            $.post("__URL__/viewTemplate", {
                "Id" : $(this).attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    $.dialog({
                        width : 200,
                        width : 300,
                        title : "活动模板",
                        content : data.data,
                        okValue : "关闭",
                        lock : true,
                        //    fixed : true,
                        ok : function() {
                            this.close();
                        }
                    })
                }
            }, 'json')
        });

    })
</script>

<body>
	<a id="add" href="javascript:void(0)">添加模板</a>
	<table id="from1">
		<tr>
			<td>编号</td>
			<td>图片</td>
			<td>名称</td>
			<td>类型</td>
			<td>设计师</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo["Id"]); ?></td>
				<td><img src="/Upload/Discount/<?php echo ($vo["Image"]); ?>" style="width:120px;height: 120px;" /></td>
				<td><?php echo ($vo["Name"]); ?></td>
				<td>
				<?php if(($vo["Type"]) == "0"): ?>单品页
					<?php else: ?>
					活动页<?php endif; ?></td>
				<td><?php echo ($vo["Designer"]); ?></td>
				<td><a href="javascript:void(0)" class="view" aid="<?php echo ($vo["Id"]); ?>">预览</a> | <a href="javascript:void(0)" class="edit" aid="<?php echo ($vo["Id"]); ?>">编辑 </a> | <a href="javascript:void(0)" class="del" aid="<?php echo ($vo["Id"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>