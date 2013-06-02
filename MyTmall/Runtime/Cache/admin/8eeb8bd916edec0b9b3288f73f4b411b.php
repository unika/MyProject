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
        $(".status").click(function() {
            if (confirm("确认" + $(this).text() + "?") === false) {
                return false;
            }
            if ($(this).text() === "上架" && $(this).attr("action", "up")) {
                change_status($(this).attr("aid"), $(this).attr("action"));
                $(this).text("下架");
                $(this).attr("aciton", "down");

            } else if ($(this).text() === "下架" && $(this).attr("action", "down")) {
                change_status($(this).attr("aid"), $(this).attr("action"));
                $(this).text("上架");
                $(this).attr("aciton", "up");
            }
            if ($(this).text() === "上架") {
                $(this).parent().parent().find(".status2").empty().append("已下架");
            } else {
                $(this).parent().parent().find(".status2").empty().append("正常");
            }

        })

        $("body").on('click', ".comment", function() {
            $.post("__GROUP__/Comment/showComment", {
                "id" : $(this).attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    var html;
                    html = "<table>";
                    html += "<tr>";
                    html += "<td>产品编号</td><td>评论标题</td><td>评论内容</td>";
                    html += "<td>评分</td><td>网站id</td><td>评论IP</td>";
                    html += "<td>评论时间</td>";
                    //html +="<td>产品编号(ProductIden)</td><td>类型编号</td>";
                    html += "</tr>";
                    $.each(data.data.result, function(index, item) {
                        html += '<tr>';
                        html += "<td>" + item.Product_id + "</td>";
                        // html += "<td>" + item.id + "</td>";
                        html += "<td>" + item.Name + "</td>";
                        html += "<td>" + item.Comment + "</td>";
                        html += "<td>" + item.Star + "</td>";
                        html += "<td>" + item.SitId + "</td>";
                        html += "<td>" + item.Ip + "</td>";
                        html += "<td>" + item.AddTime + "</td>";

                        // html += "<td>" + item.ProductIden + "</td>";
                        // html += "<td>" + item.ProductTypeId + "</td>";
                        html += '</tr>';
                    });
                    html += "</table>";
                    $.dialog({
                        title : "商品评论列表",
                        content : html,
                        lock : true,
                        okValue : "关闭",
                        ok : function() {
                            this.close();
                        },
                    })
                } else {
                    $.alert("此商品暂无评论");
                }

            }, 'json');

        })
        //更改商品状态status字段
        function change_status(id, action) {
            $.post("__URL__/changeStatus", {
                "id" : id,
                "action" : action
            }, function(data) {
                if (data.status === 0) {
                    return false;
                }
            }, 'json');
        }


        $('body').on('change', '#ProductTypeId', function() {
            if ($(this).val() !== null) {
                $(".attr tbody").empty();
                $.post("__GROUP__/ProductTypeAttr/getTypeAttr", {
                    'ProductTypeId' : $(this).val(),
                }, function(data) {
                    if (data.status == 1) {
                        var html = new String();
                        $.each(data.data, function(index, item) {
                            html += '<tr>';
                            html += '<td>' + item.Name + '</td>';
                            if (item.ParamType == 0) {
                                html += "<td>";
                                html += "<input type='text' name='attr[" + item.Name + "][]' value='" + item.DefaultValue + "' />";
                                html += "</td>";
                            } else {
                                html += '<td>';
                                $.each(item.ParamValue, function(index, items) {
                                    html += "<input type='checkbox' name='attr[" + item.Name + "][]' value='" + items + "' checked='true' />" + items;
                                })
                                html += '</td>';
                            }
                            html += '</tr>';
                        });
                    }
                    $(".attr tbody").append(html);
                }, 'json');
            }
        })
        //添加产品
        $("#add").click(function() {
            var tree;
            var editor;
            $.getJSON("__URL__/getlist1", function(data) {
                $.dialog({
                    initialize : function() {
                        editor = KindEditor.create('#content');
                        $("#ProductTypeId").html('<option>请选择类型</option>' + data.data.tree);
                        $(".hidden").attr("style", "display:none");
                        $("#DbNum").append('<option value="1" selected="selected">有货</option>');
                        $("#DbNum").append('<option value="0" >无货</option>');
                        $("#Status").append('<option value="1" selected="selected">正常</option>');
                        $("#Status").append('<option value="0" >已下架</option>');
                    },
                    title : "添加产品信息",
                    content : product,
                    lock : true,
                    button : [{
                        focus : true,
                        value : "上传图片",
                        callback : function() {
                            $.dialog({
                                title : "选择上传文件",
                                //content : '<iframe id="iframe" src="__GROUP__/Product/upload" frameborder="0"></iframe>',
                                content : uploadimage('__URL__/uploadfile'),
                                okValue : "上传",
                                ok : function() {
                                    $("#image").submit();
                                    return false;
                                },
                                cancelValue : "取消",
                                cancel : function() {
                                    this.close()
                                },
                            })
                            return false;
                        },
                    }, {
                        value : "添加",
                        callback : function() {
                            editor.sync("content");
                            $.post("__URL__/insert", $("#product").serialize(), function(data) {
                                if (data.status == 1) {
                                    //回调数据
                                    var html = new String();
                                    html += '<tr>';
                                    html += '<td>' + data.data.Id + '</td>';
                                    html += '<td><img width="100px" height="100px" src="' + data.data.Img.Img + '"></td>';
                                    html += '<td> ' + data.data.Name + ' </td>';
                                    html += '<td> ' + data.data.Price + ' </td>';
                                    html += '<td> 综合产品 </td>';
                                    html += '<td>';
                                    if (data.data.DbNum == 1) {
                                        html += '有货';
                                    } else {
                                        html += '缺货';
                                    }

                                    html += '</td>';
                                    html += '<td class="status2">';
                                    if (data.data.Status == 1) {
                                        html += '正常';
                                    } else {
                                        html += '下架';
                                    }
                                    html += '</td>';
                                    html += '<td>' + data.data.AddTime + '  </td>';
                                    html += '<td>';
                                    html += '<a aid="' + data.data.Id + ' " class="view" href="javascript:void(0)">属性</a>｜';
                                    html += '<a aid="' + data.data.Id + '  " class="edit" href="javascript:void(0)">编辑</a> ｜';
                                    html += '<a aid="' + data.data.Id + ' " class="copy" href="javascript:void(0)">复制</a>｜';
                                    html += '<a aid="' + data.data.Id + ' " class="del" href="javascript:void(0)">删除</a>｜';
                                    html += '<a aid="' + data.data.Id + ' " class="addimg" href="javascript:void(0)">图片设置</a>｜';
                                    html += '<a aid="' + data.data.Id + ' " action="down" class="status" href="javascript:void(0)">下架</a>｜';
                                    html += '<a aid="' + data.data.Id + ' " action="up" class="comment" href="javascript:void(0)">产品评论</a>';
                                    html += '</td>';
                                    html += '</tr>';
                                    $("#table").find("tr:first").after(html);
                                    $.alert(data.info);
                                } else {
                                    $.alert(data.info);
                                }

                            }, 'json')
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

        });
        //复制产品
        $("body").on('click', '.copy', function() {
            $.post("__URL__/copyProduct", {
                "Id" : $(this).attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    var html = new String();
                    html += '<tr>';
                    html += '<td>' + data.data.Id + ' </td>';
                    if (data.data.Img == null) {
                        html += '<td><img width="100px" height="100px" src="./Upload/Product/nopic.jpeg"></td>';
                    } else {
                        html += '<td><img width="100px" height="100px" src="' + data.data.Img.Img + '"></td>';
                    }
                    html += '<td>' + data.data.Name + '</td>';
                    html += '<td>' + data.data.Price + ' </td>';
                    html += '<td>' + data.data.Typename.name + ' </td>';
                    html += '<td>';
                    if (data.data.DbNum == 1) {
                        html += '有货';
                    } else {
                        html += '无货';
                    }
                    html += '</td>';
                    html += '<td class="status2">';
                    if (data.data.Status == 1) {
                        html += '正常';
                    } else {
                        html += '下架';
                    }
                    html += '</td>';
                    html += '<td>' + data.data.AddTime + '</td>';
                    html += '<td><a aid="' + data.data.Id + '" class="view" href="javascript:void(0)">属性</a>｜';
                    html += '<a aid="' + data.data.Id + '" class="edit" href="javascript:void(0)">编辑</a>｜';
                    html += '<a aid="' + data.data.Id + '" class="copy" href="javascript:void(0)">复制</a>｜ <a aid="' + data.data.Id + '" class="del" href="javascript:void(0)">删除</a>｜ <a aid="' + data.data.Id + '" class="addimg" href="javascript:void(0)">图片设置</a>｜';
                    html += '<a aid="' + data.data.Id + '" action="down" class="status" href="javascript:void(0)">下架</a>';
                    html += '｜<a aid="' + data.data.Id + '" action="up" class="comment" href="javascript:void(0)">产品评论</a></td>';
                    html += '</tr>';
                    $("#table").find("tr:first").after(html);

                } else {
                    $.alert(data.info);
                }

            }, 'json');
        })
        //删除产品
        $("body").on('click', '.del', function() {
            var obj = $(this);
            $.confirm("确认删除?", function() {
                $.post("__URL__/del", {
                    'Id' : obj.attr('aid'),
                }, function(data) {
                    if (data.status = 1) {
                        obj.parents("tr").remove();
                    } else {
                        $.alert(data.info);
                    }
                }, 'json');
                //动态删除这行
            }, function() {
                return true;
            });
        })
        //添加产品图片
        $("body").on('click', ".addimg", function() {
            var obj = $(this);
            $.post("__URL__/viewImg", {
                "ProductId" : $(this).attr("aid")
            }, function(data) {
                var html = new String();
                if (data.status == 1) {
                    html += '<table id="imglist">';
                    html += '<tr>';
                    html += '<td>编号</td>';
                    html += '<td>图片</td>';
                    html += '<td>模特图</td>';
                    html += '<td>操作</td>';
                    html += '</tr>';
                    $.each(data.data, function(index, item) {
                        html += '<tr>';
                        html += '<td>' + item.Id + '</td>';
                        html += '<td><img style="width:100px;height:100px;" src="/Upload/Product/' + item.Img + '"></td>';
                        html += '<td>';
                        if (item.UseType == 1) {
                            html += '<input type="radio" class="main" aid="' + item.Id + '" checked/>主图';
                        } else {
                            html += '<input type="radio" class="main" aid="' + item.Id + '"/>主图';
                        }
                        html += '</td>';
                        html += '<td>';
                        html += '<span class="delImg" aid="' + item.Id + '">删除</span>';
                        html += '</td>';
                        html += '</tr>';
                    })
                    html += '</table>';
                    $.dialog({
                        title : "产品图片",
                        width : 600,
                        content : html,
                        lock : true,
                        button : [{
                            focus : true,
                            value : "上传图片",
                            callback : function() {
                                $.dialog({
                                    initialize : function() {
                                        $("#file").after("<input type='hidden' id='ProductId' name='ProductId' value='" + obj.attr("aid") + "'/>");
                                    },
                                    id : "upload",
                                    title : "选择上传文件",
                                    content : uploadimage('__URL__/uploadTofile'),
                                    okValue : "上传",
                                    ok : function() {
                                        $("#image").submit();
                                        return false;
                                    },
                                    cancelValue : "关闭",
                                    cancel : function() {
                                        this.close()
                                    },
                                })
                                return false;
                            },
                        }, {
                            value : "关闭",
                            callback : function() {
                                this.close();
                            }
                        }],
                    });
                } else {
                    $.alert(data.info);
                }
            }, 'json');

        })
        //产品图片设置

        $("body").on('click', '.delImg', function() {
            obj = $(this);
            $.post("__URL__/delImg", {
                "Id" : obj.attr('aid')
            }, function(data) {
                if (data.status == 1) {
                    obj.parents("tr").remove();
                    alert(data.info);
                } else {
                    // $.alert(data.info);

                }
            }, 'json');

        })
        $("body").on("click", ".main", function() {
            if ($(this).val()) {
                $(".main").not(this).attr("checked", false);
                $.post("__URL__/updateImg", {
                    'Id' : $(this).attr('aid'),
                    'ProductId' : $("#pid").val(),
                }, function(data) {
                    $.alert(data.info);
                }, 'json');

            }
        })
        //
        //产品信息编辑
        $("body").on('click', ".edit", function() {
            var editor;
            $.post("__URL__/getlist", {
                "Id" : $(this).attr("aid")
            }, function(data) {
                $.dialog({
                    initialize : function() {
                        //对话框初始化时,请求加栽属性 开始
                        $.post("__GROUP__/ProductTypeAttr/getTypeAttr", {
                            'ProductTypeId' : data.data.ProductTypeId
                        }, function(data) {
                            if (data.status == 1) {
                                var html = new String();
                                $.each(data.data, function(index, item) {
                                    html += '<tr>';
                                    html += '<td>' + item.Name + '</td>';
                                    if (item.ParamType == 0) {
                                        html += "<td>";
                                        html += "<input type='text' name='attr[" + item.Name + "][]' value='" + item.DefaultValue + "' />";
                                        html += "</td>";
                                    } else {
                                        html += '<td>';
                                        $.each(item.ParamValue, function(index, items) {
                                            html += "<input type='checkbox' name='attr[" + item.Name + "][]' value='" + items + "' checked='true' />" + items;
                                        })
                                        html += '</td>';
                                    }
                                    html += '</tr>';
                                });
                            }
                            $(".attr tbody").append(html);
                        }, 'json');
                        //对话框初始化时,请求加栽属性 结束
                        editor = KindEditor.create('#content');
                        $("#Name").val(data.data.Name);
                        $("#Page_Title").val(data.data.Page_Title);
                        $("#Page_Keyword").val(data.data.Page_Keyword);
                        if (data.data.Img == null) {
                            $(".hidden").attr("style", "display:none");
                            $.alert("此产品还没有主图,请到点击'图片设置'上传或设置主图");
                        } else {
                            $("#img").attr("src", "/Upload/Product/m_" + data.data.Img.Img);
                        }
                        $("#Page_Description").val(data.data.Page_Description);
                        $("#Page_Url").val(data.data.Page_Url);
                        $("#SerialIden").val(data.data.SerialIden);
                        $("#Price").val(data.data.Price);
                        $("#MarketPrice").val(data.data.MarketPrice);
                        $("#content").val(data.data.Des);
                        $("#ProductTypeId").html(data.data.typetree);
                        $("#product table").find("tr:first").after("<input type='hidden' id='Id' name='Id' value='" + data.data.Id + "'/>");
                        editor.html(data.data.Des);
                        var Db = new String();
                        if (data.data.DbNum == 1) {
                            $("#DbNum").append('<option value="1" selected="selected">有货</option>');
                            $("#DbNum").append('<option value="0" >无货</option>');
                        } else {
                            $("#DbNum").append('<option value="1">有货</option>');
                            $("#DbNum").append('<option value="0" selected="selected">无货</option>');
                        }
                        var Status = new String();
                        if (data.data.Status == 1) {
                            $("#Status").append('<option value="1" selected="selected">正常</option>');
                            $("#Status").append('<option value="0" >已下架</option>');
                        } else {
                            $("#Status").append('<option value="1" >正常</option>');
                            $("#Status").append('<option value="0"  selected="selected" >已下架</option>');
                        }
                        $("#CatId option").each(function() {
                            if ($(this).val() == data.data.CatId) {
                                $(this).attr("selected", "selected");
                            }
                        })
                    },
                    title : "编辑产品信息",
                    content : product,
                    lock : true,
                    button : [{
                        disabled : true,
                        value : "上传图片",
                        callback : function() {
                            $.dialog({
                                id : "upload",
                                title : "选择上传文件",
                                content : '<iframe id="iframe" src="__GROUP__/Product/upload" frameborder="0"></iframe>',
                                okValue : "上传",
                                ok : function() {
                                    $("#iframe").contents().find("#upload").submit();
                                    return false;
                                },
                                cancelValue : "取消",
                                cancel : function() {
                                    this.close()
                                },
                            })
                            return false;
                        },
                    }, {
                        focus : true,
                        value : "更新",
                        callback : function() {
                            editor.sync("content");
                            $.post("__URL__/update", $("#product").serialize(), function(data) {
                                $.alert(data.info);
                            }, 'json')
                        }
                    }, {
                        value : "关闭",
                        callback : function() {
                            this.close();
                        }
                    }],

                });
            }, 'json');

        })
        //产品属性列表
        $("body").on("click", ".view", function() {
            $.post("__URL__/viewAttr", {
                "Id" : $(this).attr("aid")
            }, function(data) {
                if (data.status == 1) {
                    var html = new String();
                    html = "<table>";
                    $.each(data.data.AttrValue, function(index, item) {
                        html += "<tr>";
                        html += "<td>" + index + ":" + item + "</td>";
                        html += "</tr>";
                    });
                    html += "</table>";
                    $.dialog({
                        title : "产品" + data.data.Name + "属性列表",
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
    })
</script>
<body>
	<h1>产品列表 <a href="javascript:void(0)" id="add">添加产品</span></h1>
	<div>
		<form>
			产品名称：
			<input type="text" value="" name="ProductName" style="width: 120px;" id="Text1">
			<input type="submit" value="搜索" id="Submit1">
		</form>
	</div>
	<table id="table">
		<tr>
			<td> 编号 </td>
			<td> 图片 </td>
			<td> 名称 </td>
			<td> 价格 </td>
			<td> 类型 </td>
			<td> 库存 </td>
			<td> 状态 </td>
			<td> 上架时间 </td>
			<td> 操作 </td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

				<td> <?php echo ($vo["Id"]); ?> </td>
				<td><img src="<?php echo ($vo["Img"]); ?>" /></td>
				<td> <?php echo ($vo["Name"]); ?> </td>
				<td> <?php echo ($vo["Price"]); ?> </td>
				<td> <?php echo ($vo["Typename"]); ?> </td>
				<!-- 显示状态 -->
				<td>
				<?php if(($vo["DbNum"]) == "1"): ?>有货
					<?php else: ?>
					无货<?php endif; ?></td>

				<td class="status2">
				<?php if(($vo["Status"]) == "1"): ?>正常
					<?php else: ?>
					已下架<?php endif; ?></td>
				<td> <?php echo ($vo["AddTime"]); ?> </td>
				<td><a href="javascript:void(0)" class="view" aid="<?php echo ($vo["Id"]); ?>">属性</a>｜ <a href="javascript:void(0)" class="edit" aid="<?php echo ($vo["Id"]); ?>">编辑</a> ｜ <a href="javascript:void(0)" class="copy" aid="<?php echo ($vo["Id"]); ?>">复制</a>｜ <a href="javascript:void(0)" class="del" aid="<?php echo ($vo["Id"]); ?>">删除</a>｜ <a href="javascript:void(0)" class="addimg" aid="<?php echo ($vo["Id"]); ?>">图片设置</a>｜
				<?php if(($vo["Status"]) == "1"): ?><a href="javascript:void(0)" class="status" action="down" aid=<?php echo ($vo["Id"]); ?> >下架</a>
					<?php else: ?>
					<a href="javascript:void(0)" class="status" action="up" aid=<?php echo ($vo["Id"]); ?>>上架</a><?php endif; ?> ｜<a href="javascript:void(0)" class="comment" action="up" aid=<?php echo ($vo["Id"]); ?>>产品评论</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>