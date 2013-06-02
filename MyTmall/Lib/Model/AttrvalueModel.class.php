<?php
/**
 * 类型属性值操作模型
 * 2013-03-12
 * 作者:邱银乐
 */
class AttrvalueModel extends Model {
	//获取指定producttypeid的属性列表
	protected $_auto = array(//
	array('ParamValue', 'fill_ParamValue', 3, 'callback')//
	);
	protected $_validate = array(//自动验证
	array('Name', 'require', '属性名称必须'), //
	array('DefaultValue', 'require', '默认值未填'), //
	);
	public function fill_ParamValue() {
		$_POST['ParamValue'] = str_replace("\r", "", $_POST['ParamValue']);
		$param = explode("\n", trim($_POST['ParamValue']));
		return json_encode((object)$param);
	}

	public function getParamValue() {
		$list = $this -> select();
		foreach ($list as $key => $value) {
			$list[$key]['ParamValue'] = json_decode($value['ParamValue'], TRUE);
		}
		return $list;

	}

}
?>