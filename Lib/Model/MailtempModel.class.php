<?php
/**
 * 文件名：邮件模板模型
 * 功能:用于控制邮件模板读取及变量替换
 * 日期：2013-04-19
 * 作者：邱银乐
 *
 */

class MailtempModel extends Model {
	//Type模板类型，$Status是否启用,$Mark变量分割,$Data变量数组
	public function getTemp($Type, $Status, $Mark, $Data) {
		$map = array("Type" => $Type, 'status' => $Status);
		$list = $this -> where($map) -> find();
		//循环替换变量
		foreach ($Data as $key => $value) {
			$list['Body'] = str_replace($Mark . $key . $Mark, $value, $list['Body']);
		}
		return $list;
	}

}
?>