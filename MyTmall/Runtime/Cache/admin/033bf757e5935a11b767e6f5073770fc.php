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
        $("#add").click(function() {
            var mydialog = $.dialog({
                initialize : function() {
                    $("#start_time").datepicker({
                        dateFormat : "yy-mm-dd"
                    });
                    $("#end_time").datepicker({
                        dateFormat : "yy-mm-dd"
                    });
                    $(".hidden").attr("style", "display:none");
                },
                title : "添加活动",
                content : discount,
                lock : true,
                button : [{
                    focus : true,
                    value : "上传活动图片",
                    callback : function() {
                        var second = $.dialog({
                            id : "upload",
                            title : "选择上传文件",
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
                        $.post("__URL__/insert", $("#discount").serialize(), function(data) {
                            if (data.status == 1) {
                                var html = new String();
                                html = '<tr>';
                                html += '<td>   ' + data.data.id + ' </td>';
                                html += '<td><a target="_blank" href="' + data.data.url + '">';
                                html += '<img src="/Upload/Discount/' + data.data.image + '" style="width: 100px;height: 100px;"></a></td>';
                                html += '<td><a target="_blank" href="1212">' + data.data.DiscountsName + '</a></td>';
                                html += '<td><img src="/Upload/Discount/" style="width: 120px;height:120px;"></td>';
                                html += '<td>团体活动</td>';
                                html += '<td>' + data.data.start_time + '</td>';
                                html += '<td>' + data.data.end_time + '</td>';
                                html += '<td>';
                                //未判断
                                html += '<span style="color: green"> 活动进行中</span></td>';
                                html += '<td><a tid="" aid="' + data.data.Productid + '" class="preview" href="javascript:void(0)">预览活动</a> | ';
                                html += '<a tid="" aid="' + data.data.Productid + '" class="choose" href="javascript:void(0)">选择模板</a> |';
                                html += '<a aid="' + data.data.Productid + '" class="add" href="javascript:void(0)">增加产品</a> | ';
                                html += '<a aid="' + data.data.Productid + '" class="view" href="javascript:void(0)">查看产品 </a> | ';
                                html += '<a aid="' + data.data.Productid + '" class="del" href="javascript:void(0)">删除活动</a></td>';
                                html += '</tr>';
                                $("#table").find("tr:first").after(html);
                                $.alert(data.info);
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
        //jquey版本 1.9.1不在使用live 请使用on
        //删除活动下的商品
        $("body").on("click", ".delProduct", function() {
            $.post("__URL__/delProduct", {
                'productid' : $(this).attr("aid"),
                'id' : $(this).attr("pid"),
            }, function(data) {
                if (data.status == 1) {
                    $(this).parents("tr").remove();
                } else {
                    $.alert(data.info);
                }

            }, 'json');

        });
        //查看活动下的商品
        $(".view").click(function() {
            var obj = $(this);
            $.post("__URL__/viewProduct", {
                id : $(this).attr("aid"),
            }, function(data) {
                if (data.status == 1) {
                    var html;
                    html = "<table>";
                    html += "<tr>";
                    html += "<td>编号</td><td>图片</td><td>名称</td><td>价格</td><td>库存</td><td>状态</td><td>操作</td>";
                    html += "</tr>";
                    $.each(data.data, function(index, item) {
                        html += "<tr>";
                        html += "<td>" + item.id + "</td>";
                        if (item.Img != null) {
                            html += "<td><img style='width:100px;height:100px;' src='/Upload/Product/m_" + item.Img.Img + "'/></td>";

                        } else {
                            html += "<td><img style='width:100px;height:100px;' src='/Upload/Product' alt='无图'/></td>";
                        }
                        html += "<td>" + item.Name + "</td>";
                        html += "<td>" + item.Price + "</td>";
                        if (item.DbNum == 0) {
                            item.DbNum = '缺货';
                        } else {
                            item.DbNum = '正常';
                        }
                        html += "<td>" + item.DbNum + "</td>";

                        if (item.Status == 0) {
                            item.Status = '下架';
                        } else {
                            item.Status = '上架';
                        }
                        html += "<td>" + item.Status + "</td>";
                        html += "<td><input type='image' name='delProduct' value='删除' pid='" + obj.attr('aid') + "'class='delProduct' aid='" + item.id + "' /></td>";
                        html += "</tr>";

                    });
                    html += "</table>";
                    $.dialog({
                        title : '产品列表',
                        content : html,
                        lock : true,
                        okValue : "关闭",
                        ok : function() {
                            this.close()
                        }
                    })
                } else {
                    $.alert(data.info);
                }

            }, 'json');

        })
        $(".del").click(function() {
            var obj = $(this);
            $.post("__URL__/del", {
                "id" : $(this).attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    obj.parents("tr").remove();
                } else {
                    $.alert(data.info);
                }
            }, 'json')

        });
        //对于活动选择特定的模板
        $("body").on("click", ".tempchoose", function() {
            $.post("__URL__/chooseTemplate", {
                'tempid' : $(this).attr("tempid"),
                'discountid' : $(this).parents().find("input[type=hidden]").val(),
            }, function(data) {
                $.alert(data.info);
            }, 'json');
        });
        //预览活动模板
        $(".preview").click(function() {
            obj = $(this);
            var html = new String();
            $.post("__URL__/preview", {
                "id" : obj.attr("aid"),
                "tmp_id" : obj.attr("tid"),
            }, function(data) {
                if (data.status == 1) {
                    $.dialog({
                        title : "活动预览",
                        content : data.data,
                        lock : true,
                        okValue : "关闭",
                        ok : function() {
                            this.close();
                        }
                    })
                } else {
                    $.alert(data.info)
                }
            }, 'json')
        });
        //选择活动模板
        $(".choose").click(function() {
            obj = $(this);
            var html = new String();
            $.getJSON("__URL__/getTemplate", {}, function(data) {
                if (data.status == 1) {
                    data = data.data;
                    html = "<ul style='marign:0px; padding:0px;'>";
                    $.each(data, function(index, item) {
                        html += "<li style='width: 160px; height: 200px; float: left; list-style: none outside none; margin: 15px; border: 1px solid rgb(204, 204, 204);'>"
                        html += "<p><img style='width:160px; height:160px;' src='/Upload/Discount/" + item.Image + "' /></p>";
                        html += "<p>编号:" + item.Id + "名称" + item.Name;
                        if (item.Id == obj.attr("tid")) {
                            html += "<input type='radio' name='tempid' class='tempchoose' tempid='" + item.Id + "' checked='' />选定</p>";

                        } else {
                            html += "<input type='radio' name='tempid' class='tempchoose' tempid='" + item.Id + "' />选定</p>";
                        }
                        html += "</li>"
                    })
                    html += "</ul>";
                    html += "<input type='hidden' name='discountid' id='discountid' value='" + obj.attr("aid") + "' />";
                    $.dialog({
                        title : "选择活动模板",
                        width : 480,
                        content : html,
                        lock : true,
                        okValue : "关闭",
                        ok : function() {
                            this.close
                        },
                    })

                } else {
                    $.artDialog(data.info);
                }
            }, 'json');

        })
      
        //添加产品到活动
        $(".add").click(function() {
            var obj = $(this);             
            $.dialog({
                title : "选择参加活动产品",
                lock : true,
                width : 600,
                height : 480,
                content : "<iframe name='iframe' style='width:600px;min-height:480px;' src='__URL__/product/id/"+ obj.attr("aid") +"' frameborder=0></iframe>",
                okValue : "关闭",
                ok : function() {
                    this.close()
                },
            });
        });

    })
</script>

<body>
	<a id="add" href="javascript:void(0)">添加活动</a>
	<table id="table">
		<tr>
			<td>编号</td>
			<td>活动图片</td>
			<td>活动名称</td>
			<td>活动模板</td>
			<td>活动类型</td>
			<td>连接地址</td>
			<td>开始时间</td>
			<td>结束时间</td>
			<td>活动状态</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo["id"]); ?></td>
				<!-- <td><a href="<?php echo ($vo["url"]); ?>" target="_blank">查看</a></td> -->

				<td><a href="<?php echo ($vo["url"]); ?>" target="_blank"><img style="width: 100px;height: 100px;" src='/Upload/Discount/<?php echo ($vo["image"]); ?>'/></a></td>

				<td><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["DiscountsName"]); ?></a></td>

				<td><img style="width: 120px;height:120px;" src="/Upload/Discount/<?php echo ($vo["tempinfo"]["Image"]); ?>"/></td>
				<td>
				<?php if(($vo["tempinfo"]["Type"]) == "0"): ?>单品活动
					<?php else: ?>
					团体活动<?php endif; ?></td>

				<td><?php echo ($vo["start_time"]); ?></td>
				<td><?php echo ($vo["end_time"]); ?></td>
				<td>
				<?php switch($vo["valid"]): case "1": ?><span style="color: green"> 活动进行中</span><?php break;?>
					<?php case "2": ?><span style="color: red"> 活动已结束</span><?php break;?>
					<?php default: ?>
					<span style="color: black">活动未开始</span><?php endswitch;?></td>
				<td>
					<a href="javascript:void(0)" class="preview" aid="<?php echo ($vo["id"]); ?>" tid="<?php echo ($vo["tempinfo"]["Id"]); ?>" >预览活动</a> |
					<a href="javascript:void(0)" class="choose" aid="<?php echo ($vo["id"]); ?>" tid="<?php echo ($vo["tempinfo"]["Id"]); ?>" >选择模板</a> |
					<a href="javascript:void(0)" class="add" aid="<?php echo ($vo["id"]); ?>">增加产品</a> |
				    <a href="javascript:void(0)" class="view" aid="<?php echo ($vo["id"]); ?>" >查看产品 </a> |
					<a href="javascript:void(0)" class="del"  aid="<?php echo ($vo["id"]); ?>">删除活动</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>

</body>
</html>