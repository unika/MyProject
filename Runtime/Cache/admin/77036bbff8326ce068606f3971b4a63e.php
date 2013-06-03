<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>right</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="__PUBLIC__/Css/admin.css" type="text/css" rel="stylesheet" />
		<link href="__PUBLIC__/images/skin.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="17" valign="top" style="background:url('__PUBLIC__/images/mail_leftbg.gif');"><img src="__PUBLIC__/images/left-top-right.gif" width="17" height="29" /></td>
				<td valign="top" style="background:url('__PUBLIC__/images/content-bg.gif');">
				<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
					<tr>
						<td height="31">
						<div class="titlebt">
							系统信息
						</div></td>
					</tr>
				</table></td>
				<td width="16" valign="top" style="background:url('__PUBLIC__/images/mail_rightbg.gif')"><img src="__PUBLIC__/images/nav-right-bg.gif" width="16" height="29" /></td>
			</tr>
			<tr>
				<td valign="middle" style="background:url('__PUBLIC__/images/mail_leftbg.gif')">&nbsp;</td>
				<td valign="top" style="background-color:#F7F8F9;">
				<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="2" valign="top">&nbsp;</td>
						<td>&nbsp;</td>
						<td valign="top">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" valign="top"><span class="left_bt">&nbsp;</span>					
						<span class="left_txt">&nbsp;<img src="__PUBLIC__/images/ts.gif" width="16" height="16"> &nbsp; </span></td>
						<td width="7%">&nbsp;</td>
						<td width="40%" valign="top">
						<table width="100%" height="144" border="0" cellpadding="0" cellspacing="0" class="line_table">
							<tr>
								<td width="7%" height="27" style="background:url('__PUBLIC__/images/news-title-bg.gif');"><img src="__PUBLIC__/images/news-title-bg.gif" width="2" height="27"></td>
								<td width="93%" style="background:url('__PUBLIC__/images/news-title-bg.gif');" class="left_bt2">公告</td>
							</tr>
							<tr>

								<td height="102" colspan="2" valign="top">
								<ul>
									<li>
										<a href="#">公告1</a>
									</li>
									<li>
										<a href="#">公告2</a>
									</li>
									<li>
										<a href="#">公告3</a>
									</li>
									<li>
										<a href="#">公告4</a>
									</li>
									<li>
										<a href="#">公告5</a>
									</li>
								</ul></td>
							</tr>
							<tr>
								<td height="5" colspan="2">&nbsp;</td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" valign="top"><!--Javascript����-->
						<script>
                            function secBoard(n) {
                                for ( i = 0; i < sectable.cells.length; i++) {
                                    sectable.cells[i].className = "sec1";
                                    sectable.cells[n].className = "sec2";
                                }

                                for ( i = 0; i < maintable.tBodies.length; i++) {
                                    maintable.tBodies[i].style.display = "none";
                                    maintable.tBodies[n].style.display = "table";

                                }

                            }
						</script><!--HTML����-->
						<table width="72%" border="0" cellpadding="0" cellspacing="0" >
							<tbody>
								<tr align="middle" height="20" id="sectable">
									<td align="center" class="sec2" onclick="secBoard(0)">服务器配置</td>
									<td align="center" class="sec1" onclick="secBoard(1)">选项2</td>
									<td align="center" class="sec1" onclick="secBoard(2)">选项3</td>
									<td align="center" class="sec1" onclick="secBoard(3)">选项4</td>
								</tr>
							</tbody>
						</table>
						<table class="main_tab" id="maintable" cellspacing="0" cellpadding="0" width="100%" border="0">
							<!--tab1-->
							<tbody style="display:marker;">
								<tr>
									<td valign="top" align="middle">
									<table width="100%" height="133" border=0 align="center" cellpadding="0" cellspacing="0">
										<tbody>
											<!--  服务器配置信息 -->
											<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
													<td style="background-color:#FAFBFC;">&nbsp;</td>
													<td width="42%" height="25" style="background-color:#FAFBFC;"><span class="left_txt"><?php echo ($key); ?></span><span class="left_ts"> </span></td>
													<td width="54%" height="25" style="background-color:#FAFBFC;"><span class="left_txt"><?php echo ($vo); ?></span><span class="left_ts"> </span></td>
												</tr><?php endforeach; endif; else: echo "" ;endif; ?>
											<tr>
												<td height="5" colspan="3">&nbsp;</td>
											</tr>
										</tbody>

									</table></td>
								</tr>
							</tbody>
							<!--tab2-->
							<tbody style="display: none">
								<tr>
									<td valign="top" align="middle">
									<table width=98% height="133" border=0 align="center" cellpadding=0 cellspacing=0>
										<tbody>
											<tr>
												<td>ssssssssssssssss</td>
											</tr>
										</tbody>
									</table></td>
								</tr>
							</tbody>
							<!--tab3-->
							<tbody style="display: none">
								<tr>
									<td valign="top" align="middle">
									<table width=98% border=0 align="center" cellpadding=0 cellspacing=0>
										<tbody>
											<tr>
												<td colspan="3">&nbsp;</td>
											</tr>
											<tr>
												<td height="5" colspan="3">&nbsp;</td>
											</tr>

											<tr>
												<td height="25" style="background-color:#FAFBFC">&nbsp;</td>
												<td height="25" style="background-color:#FAFBFC">3</td>
												<td height="25" style="background-color:#FAFBFC">3</span></td>
											</tr>

											<tr>
												<td height="5" colspan="3">&nbsp;</td>
											</tr>
										</tbody>
									</table></td>
								</tr>
							</tbody>
							<!--tab4-->
							<tbody style="display: none">
								<tr>
									<td valign="top" align="middle">
									<table width=98% border=0 align="center" cellpadding=0 cellspacing=0>
										<tbody>
											<tr>
												<td height="5" colspan="3">&nbsp;</td>
											</tr>
											<tr>
												<td style="background-color:#FAFBFC">&nbsp;</td>
												<td style="background-color:#FAFBFC" class="left_txt">4</td>
												<td style="background-color:#FAFBFC" class="left_txt">&nbsp;</td>
											</tr>
											<tr>
												<td height="5" colspan="3">&nbsp;</td>
											</tr>
										</tbody>
									</table></td>
								</tr>
							</tbody>
						</table></td>
						<td>&nbsp;</td>
						<td valign="top">
						<table width="100%" height="144" border="0" cellpadding="0" cellspacing="0" class="line_table">
							<tr>
								<td width="7%" height="27" style="background:url(__PUBLIC__/images/news-title-bg.gif);"><img src="__PUBLIC__/images/news-title-bg.gif" width="2" height="27"></td>
								<td width="93%" style="background:url(__PUBLIC__/images/news-title-bg.gif);" class="left_bt2">服务中心信息</td>
							</tr>
							<tr>
								<td height="102" colspan="2" valign="top"><label>&nbsp;</label><label> sssss </label></td>
							</tr>
							<tr>
								<td height="5" colspan="2">&nbsp;</td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td height="40" colspan="4">
						<table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" style="background-color:#CCCCCC;">
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td width="2%">&nbsp;</td>
						<td width="51%" class="left_txt"><img src="__PUBLIC__/images/icon-mail2.gif" width="16" height="11">邮箱地址:563712987@qq.com
						<br>
						<img src="__PUBLIC__/images/icon-phone.gif" width="17" height="14"> http://localhost</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td style="background:url('__PUBLIC__/images/mail_rightbg.gif') repeat-x;">&nbsp;</td>
			</tr>
			<tr>
				<td valign="bottom" style="background:url('__PUBLIC__/images/mail_leftbg.gif');"><img src="__PUBLIC__/images/buttom_left2.gif" width="17" height="17" /></td>
				<td style="background:url('__PUBLIC__/images/buttom_bgs.gif');"><img src="__PUBLIC__/images/buttom_bgs.gif" width="17" height="17"></td>
				<td valign="bottom" style="background:url('__PUBLIC__/images/mail_rightbg.gif');"><img src="__PUBLIC__/images/buttom_right2.gif" width="16" height="17" /></td>
			</tr>
		</table>
	</body>
</html>