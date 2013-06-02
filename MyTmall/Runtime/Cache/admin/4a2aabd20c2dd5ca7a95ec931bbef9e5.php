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
        $("#add").click(function() {
            $.get("__URL__/info", function(data) {
                var html;
                if (data.data) {
                    html = data.data
                }
                $.dialog({
                    initialize : function() {
                        $("#pid").append(html);
                    },
                    title : "添加类型",
                    content : type,
                    lock : true,
                    okValue : "添加",
                    ok : function() {
                        $.post("__URL__/insert", $("#type").serialize(), function(data) {
                            if (data.status == 1) {
                                var html = new String();
                                html += '<tr>';
                                html += '<td>' + data.data.Id + '</td>';
                                html += '<td>' + data.data.PId + '</td>';
                                html += '<td>' + data.data.Name + '</td>';
                                html += '<td><a href="javascript:void(0)" class="viewAttr" aid="' + data.data.Id + '">查看属性</a>| <a href="javascript:void(0)" class="addAttr" aid="' + data.data.Id + '">增加属性</a>| <a href="javascript:void(0)" class="edit" aid="' + data.data.Id + '">编辑 </a>|<a href="javascript:void(0)" aid="' + data.data.Id + '" class="del">删除</a></td>';
                                html += '</tr>';
                                $("#table").find("tr:first").after(html);
                            } else {
                                $.alert(data.info);
                            }

                        }, 'json');
                        return false;
                    },
                    cancelValue : "关闭",
                    cancel : function() {
                        this.close();
                    }
                })
            }, 'json');
        })
        $("body").on('click', '.del', function() {
            var obj = $(this);
            $.confirm("确认删除?", function() {
                $.post("__URL__/del", {
                    'Id' : obj.attr('aid'),
                }, function(data) {
                    if (data.status == 1) {
                        obj.parents("tr").remove();
                    } else {
                        $.alert(data.info);
                    }
                }, 'json');
            }, function() {
                return false
            });
        })
        $(".edit").click(function() {
            $.post("__URL__/getlist1", {
                "Id" : $(this).attr("value")
            }, function(data) {
                if (data.status = 1) {
                    $.dialog({
                        initialize : function() {
                            $("#name").val(data.data.Name);
                            $("#name").after("<input type='hidden' id='Id' name='Id' value='" + data.data.Id + "' />")
                            $("#pid").append(data.data.typetree);
                        },
                        title : "编辑类型",
                        content : type,
                        lock : true,
                        okValue : "更新",
                        ok : function() {
                            $.post("__URL__/update", $("#type").serialize(), function(data) {
                                $.alert(data.info);
                            }, 'json')
                        },
                        cancelValue : "关闭",
                        cancel : function() {
                            this.close();
                        }
                    })
                } else {
                    $.alert(data.info);
                }
            }, 'json');
        })

        $(".viewAttr").click(function() {
            $.post("__URL__/viewAttr", {
                "Id" : $(this).attr("aid")
            }, function(data) {
                if (data.status === 1) {
                    //定义一个变量,用于关闭窗口
                    var html = new String();
                    html = "<table>";
                    html += "<tr>";
                    html += "<td>编号</td>";
                    //html += "<td>类型编号</td>";
                    html += "<td>属性名</td>";
                    html += "<td>购买属性</td>";
                    html += "<td>类型</td>";
                    html += "<td>参数值</td>";
                    html += "<td>默认值</td>";
                    html += "<td>搜索</td>";
                    html += "<td>排序</td>";
                    html += "<td>显示</td>";
                    html += "<td>长度</td>";
                    html += "<td>操作</td>";
                    html += "</tr>";
                    $.each(data.data, function(index, item) {
                        html += "<tr>";
                        html += "<td>" + item.Id + "</td>";
                        //html += "<td>" + item.ProductTypeId + "</td>";
                        html += "<td>" + item.Name + "</td>";
                        if (item.IsBuyType == 0) {
                            item.IsBuyType = "否";
                        } else {
                            item.IsBuyType = "是";
                        }
                        html += "<td>" + item.IsBuyType + "</td>";
                        if (item.ParamType == 0) {
                            item.ParamType = "输入";
                        } else {
                            item.ParamType = "多选";
                        }
                        html += "<td>" + item.ParamType + "</td>";
                        html += "<td>" + item.ParamValue + "</td>";
                        html += "<td>" + item.DefaultValue + "</td>";
                        if (item.IsSearchAttr == 0) {
                            item.IsSearchAttr = "否";
                        } else {
                            item.IsSearchAttr = "是";
                        }

                        html += "<td>" + item.IsSearchAttr + "</td>";
                        html += "<td>" + item.AttrOrder + "</td>";

                        if (item.BuySelStyle == 0) {
                            item.BuySelStyle = "Div块";
                        } else if (item.BuySelStyle == 1) {
                            item.BuySelStyle = "下拉";
                        } else {
                            item.BuySelStyle = "输入";
                        }
                        html += "<td>" + item.BuySelStyle + "</td>";
                        html += "<td>" + item.MaxLength + "</td>";
                        html += "<td><a href='javascript:void(0)' class='delAttr' aid='" + item.id + "'>删除</a></td>";
                        html += "</tr>";
                    })
                    html += "</table>";
                    var my = $.dialog({
                        title : "本类型下的属性列表",
                        content : html,
                        lock : true,
                        okValue : "关闭",
                        ok : function() {
                            my.close();
                        }
                    })
                } else {
                    $.alert(data.info);
                }
            }, 'json');
        });
        $("body").on('click', '.delAttr', function() {
            var obj = $(this);
            $.post("__URL__/delAttr", {
                "Id" : $(this).attr('aid')
            }, function(data) {
                if (data.status == 1) {
                    obj.parents("tr").remove();
                    $.alert(data.info);

                } else {
                    $.alert(data.info);
                }

            }, 'json');
        });
        $(".addAttr").click(function() {
            var obj = $(this);
            $.dialog({
                initialize : function() {
                    $("#ProductTypeId").val(obj.attr("aid"))
                },
                title : "增加属性",
                content : attr,
                lock : true,
                okValue : "添加",
                ok : function() {
                    $.post("__URL__/insertAttr", $("#attr").serialize(), function(data) {
                        $.alert(data.info);
                    }, 'json');
                    return false;
                },
            })
        });

    })
</script>
<body>
	<h3>产品类型列表</h3>
	<table id="table">		
		<tr>
			<td> <?php echo ($list); ?> </td>
		</tr>
	</table>
	</form>
	<div class="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>