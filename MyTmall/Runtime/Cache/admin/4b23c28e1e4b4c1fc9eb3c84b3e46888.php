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
        $(".del").click(function() {
            $.post("__URL__/del", {
                'id' : $(this).attr("aid")
            }, function(data) {
                $.alert(data.info);
            }, 'json');
            $(this).parents("tr").remove();
        })
        $(".edit").click(function() {
            $.post("__URL__/getAdInfo", {
                'id' : $(this).attr("aid")
            }, function(data) {
                if (data.status = 1) {
                    $.dialog({
                        initialize : function() {
                            $("#Name").val(data.data.Name);
                            $("#Url").val(data.data.Url);
                            $("#Link").val(data.data.Link);
                            $("#start_time").val(data.data.start_time);
                            $("#end_time").val(data.data.end_time);
                            $("#img").attr("src", "/Upload/Admanager/" + data.data.image);
                            $("#Name").after("<input type='hidden' name='id'id='id' value='" + data.data.id + "' />");
                            $("#start_time").datepicker({
                                dateFormat : "yy-mm-dd"
                            });
                            $("#end_time").datepicker({
                                dateFormat : "yy-mm-dd"
                            });
                        },
                        title : "广告编辑",
                        content : ad,
                        lock : true,
                        button : [{
                            focus : true,
                            value : "更换图片",
                            callback : function() {
                                $.dialog({
                                    id : "upload",
                                    title : "选择上传文件",
                                    content : uploadimage('__URL__/uploadtTofile'),
                                    okValue : "上传",
                                    ok : function() {
                                        $("#image").submit();
                                        return false;
                                    },
                                })
                                return false;
                            }
                        }, {
                            value : "更新",
                            callback : function() {
                                $.post("__URL__/update", $("#ad").serialize(), function(data) {
                                    $.alert(data.info);
                                }, 'json');

                            }
                        }, {
                            value : "取消",
                            callback : function() {

                            }
                        }]
                    });
                } else {
                    $.alert($data.info);
                }

            }, 'json')

        })
        $(".view").click(function() {
            $.post("__URL__/getClickInfo", {
                "id" : $(this).attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    var html;
                    html = "<table>";
                    html += "<tr>";
                    html += "<td>编号</td><td>Ip地址</td><td>点击时间</td>";
                    html += "</tr>";
                    $.each(data.data, function(index, item) {
                        html += "<tr>";
                        // html += "<td>" + item.Id + "</td>";
                        html += "<td>" + item.ImgNo + "</td>";
                        html += "<td>" + item.Ip + "</td>";
                        html += "<td>" + item.ClickTime + "</td>";
                        html += "</tr>";
                    })
                    html += "</table>";
                    $.dialog({
                        title : "广告点击详情",
                        content : html,
                        lock : true,
                        okValue : "关闭",
                        ok : function() {
                            this.close();
                        }
                    })
                } else {
                    $.alert(data.info);
                }

            }, 'json');
        })

        $("#add").click(function() {
            $.dialog({
                initialize : function() {
                    $("#start_time").datepicker({
                        dateFormat : "yy-mm-dd"
                    });
                    $("#end_time").datepicker({
                        dateFormat : "yy-mm-dd"
                    });
                },
                title : "添加广告",
                content : ad,
                lock : true,
                button : [{
                    focus : true,
                    value : "上传图片",
                    callback : function() {
                        $.dialog({
                            id : "upload",
                            title : "选择上传文件",
                            content : uploadimage('__URL__/uploadtTofile'),
                            okValue : "上传",
                            ok : function() {
                                $("#image").submit();
                                return false;
                            },
                        })
                        return false;
                    }
                }, {
                    value : "添加",
                    callback : function() {
                        $.post("__URL__/insert", $("#ad").serialize(), function(data) {
                            $.alert(data.info);
                        }, 'json');
                        return false;
                    }
                }],
            });
        })
    })
</script>
<a id="add" href="javascript:void(0)">添加广告</a>
<table>
	<tr>
		<td>广告</td>
		<td>链接</td>
		<td>图片</td>
		<td>开始时间</td>
		<td>结束时间</td>
		<td>状态</td>
		<td>点击</td>
		<td>操作</td>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($vo["Name"]); ?></td>
			<td><?php echo ($vo["Url"]); ?></td>
			<td><img src="/Upload/Admanager/<?php echo ($vo["image"]); ?>" style="width:160px;height: 160px" /></td>
			<td><?php echo ($vo["start_time"]); ?></td>
			<td><?php echo ($vo["end_time"]); ?></td>
			<td>
			<?php switch($vo["valid"]): case "1": ?><span style="color: green"> 广告进行中</span><?php break;?>
				<?php case "2": ?><span style="color: red"> 广告已结束</span><?php break;?>
				<?php default: ?>
				<span style="color: black">广告未开始</span><?php endswitch;?></td>
			<td>
			<?php if(!empty($vo["click"])): echo ($vo["click"]); ?>次
				<?php else: ?>
				0次<?php endif; ?></td>
			<td><a class="view" aid="<?php echo ($vo["id"]); ?>" href="javascript:void(0)">查看</a> | <a class="edit" aid="<?php echo ($vo["id"]); ?>" href="javascript:void(0)">编辑</a>|<a class="del" aid="<?php echo ($vo["id"]); ?>" href="javascript:void(0)">删除</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div id="page">
	<?php echo ($page); ?>
</div>
</body>
</html>