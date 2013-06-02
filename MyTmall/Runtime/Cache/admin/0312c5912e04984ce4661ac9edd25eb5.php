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
        $("#ProductTypeId").change(function() {
            $.post("__GROUP__/Discount/getProduct", {
                'ProductTypeId' : $(this).val(),
            }, function(data) {
                if (data.status == 1) {
                    //类型下的产品信息列表
                    html = new String();
                    $.each(data.data, function(index, item) {
                        html += "<tr class='tr'>";
                        html += "<td><input type='checkbox' name='product[]' class='check' value='" + item.Id + "' />";
                        html += item.Id + "</td>";
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

                        html += "</tr>";
                    });
                    $(".tr").remove();
                    $("#table").find("tr:first").after(html);
                } else {
                    $.alert(data.info);
                }
            }, 'json');

        });

        $("input[type='checkbox']").click(function() {
            if ($(this).prop("checked")) {
                $.post("__URL__/addProduct", {
                    "Productid" : $(this).val(),
                    "id" : $("#Classify").val()
                }, function(data) {
                    $.alert(data.info);
                }, 'json')
            } else {
                $.post("__URL__/delProduct", {
                    "Productid" : $(this).val(),
                    "id" : $("#Classify").val()
                }, function(data) {
                    $.alert(data.info);
                }, 'json')
            }
        })
    }); 
</script>
<body>
	<div>
		产品类型
		<select id='ProductTypeId' name='ProducTypeId'>
			<?php echo ($data); ?>
		</select>
	</div>
	<table id="table">
		<tr>
			<td>编号</td><td>图片</td><td>名称</td><td>价格</td><td>库存</td><td>状态</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr">
				<td>
				<input type='checkbox' name='product[]' class='check' value='<?php echo ($vo["Id"]); ?>' />
				<?php echo ($vo["Id"]); ?></td>
				<td>
				<?php if(empty($vo["Img"]["Img"])): ?><img style='width:100px;height:100px;' src='/Upload/System/noimgae.jpg' />
					<?php else: ?>
					<img style='width:100px;height:100px;' src='/Upload/Product/m_<?php echo ($vo["Img"]["Img"]); ?>'/><?php endif; ?></td>
				<td><?php echo ($vo["Name"]); ?> </td>
				<td><?php echo ($vo["Price"]); ?></td>
				<td><?php echo ($vo["DbNum"]); ?></td>
				<td><?php echo ($vo["Status"]); ?> </td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>

		<input type="hidden" id="Classify" value="<?php echo ($id); ?>"/>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>

</body>
</html>