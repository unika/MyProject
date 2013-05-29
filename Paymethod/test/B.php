<form name=form2 id=form2 method=post action=C.php>
	产品名称：
	<input type=text name=prcname />
	产品价格：
	<input type=text name=price />
	产品型号：
	<input type=text name=prcXH />
	<input type=hidden name=base1 value="<?php echo $_REQUEST['base1'] ?>" />
	<input type=hidden name=base2 value="<?php echo $_REQUEST['base2'] ?>" />
	<input type=submit value=下一步 />
</form>
