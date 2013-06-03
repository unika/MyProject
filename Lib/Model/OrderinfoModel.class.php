<?php
/**
 * 文件:订单模型类
 * 日期:2013-04-16
 * 功能:对于订单的操作,包括增删改,订单自动过期,过期前一周执行(自动计划)发送邮件提醒客户
 * 作者:邱银乐
 */
class Orderinfo extends Model {
	protected $_auto = array(//
	array("OrderId", 'fill_id', 3, 'callback'), //
	);
	public function fill_date() {
		$AddTime = date("Y-m-d H:i:s");
		return $AddTime;
	}

	public function fill_productid() {
		$AddTime = date("Y-m-d H:i:s");
		return $AddTime;
	}
	//保证唯一性,应该加上一个唯一值比如uid,uid暂时2013
	//记得更改
	function fill_id() {
		$fill_id = date("YmdHis");
		return $fill_id;
	}

}
?>