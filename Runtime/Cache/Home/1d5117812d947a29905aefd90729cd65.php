<?php if (!defined('THINK_PATH')) exit(); foreach($category as $key=>$row){ ?>
<?php switch($Display){ case "nav": ?>
<a target="_top" href="/Category/<?php echo ($row["info"]["Name"]); ?>"><?php echo ($row["info"]["Name"]); ?></a> &gt;
<?php break; case "tree": ?>
<!--一级分类开始 -->
<li class="">
	<a target="_top" href="/Category/<?php echo ($row["info"]["Name"]); ?>"><?php echo ($row["info"]["Name"]); ?></a>
	<!--二级分类开始 -->
	<div class="">
		<ul>
			<?php foreach($category[$key]['child'] as $subrow){ ?>
			<li class="">
				<a target="_top" href="/Category/<?php echo ($subrow["info"]["Name"]); ?>"><?php echo ($subrow["info"]["Name"]); ?></a>
			</li>
			<?php } ?>
		</ul>

	</div>
	<!--二级分类结束 -->
</li>
<!--一级分类结束 -->

<?php } } ?>