<?php
/**
 * 产品分类模型
 */
class ProductclassifyModel extends Model {
	public function getInfo() {
		$list = $this -> select();
		foreach ($list as $key => $value) {
			$count = count(json_decode($value['ProductIdList']), TRUE);
			$list[$key]['count'] = $count;
		}
		return $list;
	}

	//$Pid为要移除的产品id
	public function remove($Productid) {
		$result = $this -> find();
		$array = json_decode($result['ProductIdList'], TRUE);
		$key = array_search($Productid, $array);
		unset($array[$key]);
		return $this -> where('Id=' . $result['Id']) -> setField("ProductIdList", json_encode(array_values($array)));

	}

}
?>