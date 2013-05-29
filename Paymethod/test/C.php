<form name=form3 id=form3 method=post action=D.php>
	其他信息1：
	<input type=text name=other1 />
	其他信息2：
	<input type=text name=other2 />
	<input type=hidden name=base1 value=<?php echo $_REQUEST['base1'] ?> />
	<input type=hidden name=base2 value=<?php echo $_REQUEST['base2'] ?> />
	<input type=hidden name=prcname value=<?php echo $_REQUEST['prcname'] ?> />
	<input type=hidden name=price value=<?php echo $_REQUEST['price'] ?> />
	<input type=hidden name=prcXH value=<?php echo $_REQUEST['prcXH'] ?> />
	<input type=submit value=确定 />
</form>
