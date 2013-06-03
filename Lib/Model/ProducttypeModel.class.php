<?php
/*
 *
 * 产品类型模型
 * 日期2013-03-12
 * 作者:邱银乐
 *
 */
class ProducttypeModel extends Model {
	public $typetree;
	public function getList($id) {
		$list = $this -> select();
		return $list;
	}

	public function getProductType($id) {
		$list = $this -> find($id);
		return $list;
	}

	//下拉
	public function getTypetree($delmit, $list) {
		global $typetree;
		foreach ($list as $key => $first) {
			$typetree .= "<option value='" . $first['info']['Id'] . "'>" . $delmit . $first['info']['Name'] . "</option>";
			if (is_array($first['child'])) {
				$this -> getTypetree($delmit . $delmit, $first['child']);
			}
		}
		return $typetree;
	}

	//树状
	public function getListtree($delmit, $list) {
		global $typetree;
		foreach ($list as $key => $first) {
			$typetree .= "<ul style='padding: 0px; margin: 0px 0px 0px 16px;'>";
			$typetree .= "<li style='list-style:none outside none'>" . $delmit . $first['info']['Name'] . "<a href='javascript:void(0)' class='edit' value='" . $first['info']['Id'] . "'>编辑</a></li>";
			if (is_array($first['child'])) {
				$this -> getListtree($delmit . $delmit, $first['child']);
			}
			$typetree .= "</ul>";
		}
		return $typetree;
	}

	//选中类型
	public function selectType($delmit, $list, $id) {
		global $selecttype;
		foreach ($list as $key => $first) {
			if ($first['info']['Id'] == $id) {
				$selected = "selected='selected'";
			} else {
				$selected = NULL;
			}
			$selecttype .= "<option value='" . $first['info']['Id'] . "'" . $selected . ">" . $delmit . $first['info']['Name'] . "</option>";
			if (is_array($first['child'])) {
				$this -> selectType($delmit . $delmit, $first['child'], $id);
			}
		}
		return $selecttype;
	}

	public function getInfo() {
		$list = $this -> find();
		$attr = D("Attrvalue");
		$map['ProductTypeId'] = $list['Id'];
		$map['IsBuyType'] = 1;
		$list['AttrValue'] = $attr -> where($map) -> select();
		foreach ($list['AttrValue'] as $key => $value) {
			$list['AttrValue'][$key]['ParamValue'] = json_decode($value['ParamValue'], TRUE);
		}
		return $list;
	}

}
?>