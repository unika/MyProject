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
        $("body").on("focus", "#start_time", function() {
            $(this).datepicker({
                dateFormat : "yy-mm-dd"
            });
        })
        $("body").on("focus", "#end_time", function() {
            $(this).datepicker({
                dateFormat : "yy-mm-dd"
            });
        })
        $("body").on("change", "#adType", function() {
            var tmp = $(this).val();
            var obj1 = $(this).parent().parent().next().find("td:first");
            var obj2 = $(this).parent().parent().next().find("td:last");
            switch(tmp) {
                case tmp='0':
                    obj1.text("网址");
                    obj2.html("<input type='text' name='Url' id='Url' />");
                    break;
                case tmp='1':
                    obj1.text("可选单品");
                    $.post("__GROUP__/Discount/getDiscount", {
                        "type" : "1"
                    }, function(data) {
                        if (data.status == 1) {
                            obj2.html("<input type='radio' name='Url' id='Url' />");
                        } else {
                            alert(data.info);
                        }
                    }, 'json')
                    break;
                case tmp='2':
                    obj1.text("可选活动");
                    $.post("__GROUP__/Discount/getDiscount", {
                        "type" : "2"
                    }, function(data) {
                        if (data.status == 1) {
                            var html = new String();
                            $.each(data.data, function(index, item) {
                                html += '<div>';
                                html += item.id;
                                html += item.DiscountsName;
                                html += '<img src="/Upload/Discount/' + item.image + '"/>';
                                html += item.start_time;
                                html += item.end_time;
                                html += '<input type="radio" name="url" value="' + item.id + '" /></div>';

                            })
                            obj2.html(html);
                        } else {
                            alert(data.info);
                        }
                    }, 'json')
                    break;
            }

        })

        $(".del").click(function() {
            var obj = $(this);
            $.post("__URL__/del", {
                'id' : obj.attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    obj.parents("tr").remove();
                } else {
                    $.alert(data.info);
                }
            }, 'json');

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
                            $("#Name").after("<input type='hidden' name='id' id='id' value='" + data.data.id + "' />");
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
                            value : "关闭",
                            callback : function() {
                                this.close();

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
                    $(".hidden").attr("style", "display:none");
                },
                width : 600,
                height : 400,
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
                    value : "提交",
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
			<?php if(empty($vo["click"])): ?>0
				<?php else: ?>
				<?php echo ($vo["click"]); endif; ?>次 </td>
			<td><a class="edit" aid="<?php echo ($vo["id"]); ?>" href="javascript:void(0)">编辑</a>| <a class="del" aid="<?php echo ($vo["id"]); ?>" href="javascript:void(0)">删除</a>| <a class="view" aid="<?php echo ($vo["id"]); ?>" href="javascript:void(0)">查看效果</a></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div id="page">
	<?php echo ($page); ?>
</div>
</body>
</html>