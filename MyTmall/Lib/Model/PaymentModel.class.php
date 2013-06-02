<?php
/**
 * 支付模型
 * 2013-05-11
 */
class PaymentModel extends Model {
	protected $_validate = array(//自动验证
	array('Name', 'require', '支付名称必须'), //
	array('logo', 'require', '支付logo未上传'), //
	array('Price', 'require', '支付价格必须'), //
	array('Status', 'require', '支付状态未选'), //
	array('Iden', 'require', '支付描述未填'), //

	);
}
?>