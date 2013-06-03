<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title>产品活动模班页</title>
			<style>
				body {
					width:980px;
					min-height: 1002px;
					margin:auto;
					text-align:center;
				}
				h1{
					    font-weight: normal;
						margin: 0;
						text-align: center;
				}
				ul{
					margin: 0;
					padding: 0;
				}
				li{
					    border: 1px solid #CCCCCC;
						float: left;
						list-style: none outside none;
						margin: 2px;
						width: 220px;
				}				
				img{
					border:none;
					width:220px;
					height:180px;
				}
			</style>
	</head>
        
	<body>
		<h1>产品活动模班页</h1>
          <ul>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<img src="/Upload/Product/<?php echo ($vo["Img"]["Img"]); ?>" alt="no image" />
					<p><?php echo ($vo["Name"]); ?></p>				
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
	</body>
</html>