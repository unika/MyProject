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
    $(document).ready(function(data) {
        $(".add").click(function() {
            var mydialog = $.dialog;
            mydialog({
                title : "支付方式",
                content : payment,
                lock : true,
                button : [{
                    focus : true,
                    value : "上传logo",
                    callback : function() {
                        $.dialog({
                            title : "支付公司logo",
                            content : uploadimage("__URL__/uploadTofile"),
                            okValue : "上传",
                            ok : function() {
                                $("#image").submit();
                                return false;
                            },
                            cancelValue : "关闭",
                            cancel : function() {
                                this.close();
                            }
                        })
                        return false;
                    }
                }, {
                    value : "添加",
                    callback : function() {
                        $.post("__URL__/insert", $("#payment").serialize(), function(data) {
                            if (data.status == 1) {
                                var html = new String();
                                html = '<tr>';
                                if (data.data.logo != "") {
                                    html += '<td><img src="/Upload/Payment/' + data.data.logo + '" style="width:160px;" /></td>';
                                } else {
                                    html += '<td><img src="/Upload/noimage.png" style="width:160px;" /></td>';
                                }
                                html += '<td>' + data.data.Name + '</td>';
                                html += '<td>' + data.data.Price + '</td>';
                                html += '<td>' + data.data.Status + '</td>';
                                html += '<td>' + data.data.Name + '</td>';
                                html += '<td><a class="del" href="javascript:void(0)" aid="' + data.data.id + '">删除</a>';
                                html += '</td>';
                                html += '</tr>';
                                $("#form1").find("tr:first").after(html);
                                //
                                // $.alert(data.info);
                            } else {
                                $.alert(data.info);
                            }

                        }, 'json');
                        return false;
                    }
                }, {
                    value : "取消",
                    callback : function() {
                        this.close();
                    }
                }],

            });

        });
        $("body").on("click", ".del", function() {
            var obj = $(this);
            $.confirm("确认要删除吗?", function() {
                $.post("__URL__/del", {
                    "id" : obj.attr("aid"),
                }, function(data) {
                    if (data) {
                        obj.parents("tr").remove();
                    } else {
                        $.alert("没有找到数据");
                    }
                }, 'json');
            })
        })
    }); 
</script>
</head>

<body>
	<h1><a class="add" href="javascript:void(0)">添加支付方式 </a></h1>
	<table id="form1">
		<tr>
			<td>Logo</td><td>支付公司</td><td>价格</td><td>是否启用</td><td>价格波动</td><td>操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td>
				<?php if(empty($vo["logo"])): ?><img src="/Upload/noimage.png" style="width:160px;" />
					<?php else: ?>
					<img src="/Upload/Payment/<?php echo ($vo["logo"]); ?>" style="width:160px;" /><?php endif; ?></td><td><?php echo ($vo["Name"]); ?></td><td><?php echo ($vo["Price"]); ?></td><td><?php echo ($vo["Status"]); ?></td><td><?php echo ($vo["DynamicPrice"]); ?></td><td><a class="del" aid="<?php echo ($vo["id"]); ?>" href="javascript:void(0)">删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>

	</table>
	<div id="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>