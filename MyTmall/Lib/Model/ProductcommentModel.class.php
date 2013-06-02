<?php
/**
 * 商品评论模型
 * 日期:2013-03-13
 * 作者:邱银乐
 *
 */
class ProductcommentModel extends Model {
	protected $_auto = array(//自动填充
	array('AddTime', 'fill_date', 1, 'callback'), //填充添加时间
	array('Ip', 'get_client_ip', 1, 'function'), //填充注册
	);
	protected $_validate = array(//自动验证
	array('Name', 'require', '标题必须'), //标题名
	array('Star', 'require', '未评分数'), //分数名必须
	array('Comment', 'require', '内容必须'), //内容必须
	);
	public function fill_date() {
		$AddTime = date("Y-m-d H:i:s");
		return $AddTime;
	}

}
?>