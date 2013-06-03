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
        $('body').on("click", "#source ul li", function() {
            var obj = $(this);
            $("#target").find("input[name='level[]']:last").each(function() {
                if ($(this).val() == '') {
                    $(this).val('[' + obj.text() + ']');
                    $(this).attr('json', obj.attr("aid"));
                } else {
                    $(this).val($(this).val() + '+[' + obj.text() + ']');
                    $(this).attr('json', $(this).attr('json') + ',' + obj.attr("aid") + '"');

                }

            })
            // $(this).clone().prependTo("#target ul");
            $(this).remove();
        });
        $('body').on("click", "#target ul li", function() {
            $(this).clone().prependTo("#source ul");
            $(this).remove();
        });
        $('body').on("change", "select", function() {
            $.getJSON("__GROUP__/ProductTypeAttr/getAttrList", {
                "ProductTypeId" : $(this).val(),
            }, function(data) {
                if (data.status == 1) {
                    var html = new String();
                    $("#source").find("ul").remove();
                    $("#target").find("input").parent().remove();
                    html += "<ul>";
                    $.each(data.data, function(index, item) {
                        html += "<li aid=" + index + ">" + item + "</li>";
                    })
                    html += "</ul>"
                    $("#source").find("h1").after(html);
                } else {
                    $.alert(data.info);
                }
            }, 'json');

        })

        $("body").on('click', 'button', function() {
            $("#target").append("<div style='padding: 10px;'><span style='margin-right: 2px;color:#cccccc;'>目录</span><input style='clear: both; width: 85%; border: 1px solid rgb(204, 204, 204);' type='text' name='level[]' value='' /><input type='image' style='margin-left: 3px;color:#cccccc;' class='delme' onsubmit='return false' alt='x' /></div>");

        })
        $("body").on('click', '.delme', function() {
            $(this).parent().remove();
        })
        $(".edit").click(function() {
            var obj = $(this);
            $.post("__URL__/getinfo", {
                "Id" : obj.attr("value")
            }, function(data) {
                if (data.status == 1) {
                    $.dialog({
                        initialize : function() {
                            editor = KindEditor.create('#content');
                            $("#Name").val(data.data.Name);
                            $("#Page_Title").val(data.data.Page_Title);
                            $("#Page_Keyword").val(data.data.Page_Keyword);
                            $("#Page_Description").val(data.data.Page_Description);
                            $("#Page_Url").val(data.data.Page_Url);
                            editor.html(data.data.Des);
                            $("#category_seo").find("tr:last").after("<input type='hidden' id='Id' name='Id' value='" + obj.attr("value") + "' />")
                        },
                        lock : true,
                        "title" : "分类seo",
                        "content" : category_seo,
                        okValue : "保存",
                        ok : function() {
                            editor.sync("#content");
                            $.post("__URL__/updateCategory", $("#category_seo").serialize(), function(data) {
                                if (data.status == 1) {
                                    $.alert(data.info);
                                } else {
                                    $.alert(data.info);
                                }

                            }, 'json');
                            return false;
                        },
                        cancelValue : "取消",
                        cancel : function() {
                            this.close();
                        }
                    })
                } else {
                    $.alert(data.info);
                }
            }, 'json')
        })

        $("#addCategory").click(function() {
            $.getJSON("__GROUP__/ProductType/getlist1", {}, function(data) {
                if (data.status == 1) {
                    var html = new String();
                    html = '<select name="typelist" style="margin:0px;padding:0;clear:both;">';
                    html += '<option>请选择类型</option>'
                    html += data.data.typetree;
                    html += "</select>";
                    html += "<button>添加目录</button>"
                    $.dialog({
                        initialize : function() {
                            $("#source").append("<h1>可选目录</h1>");
                            $("#Category").before(html);
                        },
                        width : 800,
                        height : 400,
                        lock : true,
                        title : "目录列表",
                        content : category,
                        okValue : "创建目录",
                        ok : function() {
                            var array = new Array();
                            var json = new Array();
                            $("#target input[name='level[]']").each(function() {
                                array.push($(this).val());
                                json.push($(this).attr("json"));
                            })

                            $.post("__URL__/addCategory", {
                                'category' : array,
                                'categoryId' : json,
                                'ProductTypeId' : $("select").val()
                            }, function(data) {
                                if (data.status == 1) {
                                    // var html = new String();
                                    // $.each(data.data, function(index, item) {
                                    // html += '<tr>';
                                    // html += '<td>' + item + '</td>';
                                    // html += '<td>' + index + '</td>';
                                    // html += '<td><a href="javascript:void(0)" aid="' + index + '">删除</a></td>';
                                    // html += '</tr>';
                                    // })
                                    // $("#table").find("tr:first").after(html);
                                    $.alert(data.info);
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
                } else {
                    $.alert(data.info);
                }
            }, 'json');

        })
    })

</script>
<body>
	<h1><a href="javascript:void(0)" id="addCategory">创建目录</a></h1>
	<table id="table">
		<tr>
			<td>类名</td>
			<td>产品数</td>
			<td>操作</td>
		</tr>
		<tr>
			<td><?php echo ($list); ?></td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo); ?></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><a href="javascript:void(0)" aid="<?php echo ($vo["id"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>

</body>
</html>