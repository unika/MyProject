<?php
/**
 * 文件:广告点击记录模型
 * 日期:2013-03-26
 * 功能:用于记录用户点击广告的次数和行为
 * 作者:邱银乐
 */
class CouponModel extends Model {
	protected $_auto = array(//自动验证,和填充
	array('Status', '1'), //填充注册
	array('ClickTime', 'fill_date', 1, 'callback'), //填充注册时间
	);
	public function fill_date() {
		$AddTime = date("Y-m-d H:i:s");
		return $AddTime;
	}

}
?>