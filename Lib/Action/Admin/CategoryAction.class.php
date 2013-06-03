<?php
/**
 * 系统分类
 */
class CategoryAction extends Action {
	public function index() {
		import("ORG.Util.Page");
		$category = D("Category");
		$count = $category -> count();
		$page = New Page($count, 25);
		$data = $category -> select();
		$data = arrayPidProcess($data, $res, '0', '0');
		$list = $category -> getListtree('-', $data);
		$this -> assign("list", $list);
		$this -> assign("page", $page -> show());
		$this -> display();
	}

	public function getinfo() {
		$Id = $this -> _post("Id");
		$category = D("Category");
		$data = $category -> find($Id);
		if ($data) {
			$this -> ajaxReturn($data, '', 1);
		} else {
			$this -> error("错误");
		}
	}

	//更新分类信息
	public function updateCategory() {
		$category = D("Category");
		$category -> create();
		$category -> Des = $this -> _post("content");
		if ($category -> save() !== false) {
			$this -> success("保存成功");
		} else {
			$this -> error("保存失败");
		}
	}

	public function addCategory() {
		$category = D("Category");
		$productattr = D("Productattrvalue");
		$attrValue = D("Attrvalue");
		$aggregate = D("productaggregate");
		$model = new Model();
		//通过传递过来的属性名查询值得
		$array = $this -> _post('category');
		$categoryId = $this -> _post('categoryId');
		$TypeId = $this -> _post('ProductTypeId');
		$model -> query("drop table shop_attrtmp");
		$count = count($array);
		foreach ($categoryId as $key => $value) {
			if (($key + 1) == $count) {
				$condition .= "MAX(IF(typeattrid= '$value', AttrValue,NULL)) AS 'level$value'";
				$IN .= $value;
			} else {
				$condition .= "MAX(IF(typeattrid= '$value', AttrValue,NULL)) AS 'level$value',";
				$IN .= $value . ',';
			}
		}

		$sql = <<<end
		CREATE TABLE shop_attrtmp
		select 
		productid,
			$condition
				from(
					select a.productId,a.TypeAttrId,a.AttrValue from shop_productattrvalue as a 
						inner join shop_product as  b on a.ProductId=b.Id 
						where TypeAttrId in($IN) and b.ProductTypeId in(75)
		)as temp GROUP BY  productid; 	
end;

		$model -> query($sql);
		//读取临时表中的数据唯一性
		foreach ($categoryId as $key => $value) {
			if ($key == 0) {
				$level = "level" . $value;
				$sql = 'select distinct ' . $level . ' from shop_attrtmp';
				$result = $model -> query($sql);
				foreach ($result as $subkey => $subvalue) {
					$category -> Pid = 0;
					$category -> Name = $subvalue[$level];
					$prev = $subvalue[$level];
					$id = $category -> add();
				}
			} else {
				$level = "level" . $categoryId[$key];
				$uplevel = "level" . $categoryId[$key - 1];
				$sql = 'select distinct ' . $level . ' from shop_attrtmp where ' . $uplevel . ' like "' . $prev . '"';
				$result = $model -> query($sql);
				foreach ($result as $key => $value) {
					$category -> Pid = $id;
					$category -> Name = $value[$level];
					$ids = $category -> add();
					$model -> query("select count(productid) from shop_attrtmp where $level like '" . $value[$level] . "' and $uplevel like '$prev'");
					$sql1 = "select productid from shop_attrtmp where $level like '" . $value[$level] . "' and $uplevel like '$prev'";
					$productlist = $model -> query($sql1);
					foreach ($productlist as $key => $value) {
						$aggregate -> CategroyId = $ids;
						$aggregate -> ProductId = $value['productid'];
						$result = $aggregate -> add();
					}
				}
			}
		}
		if ($result) {
			$this -> success("创建成功");
		} else {
			$this -> error("创建失败");
		}

		//echo $category -> getLastsql();
		//
		// $level = "level" . $categoryId[0];
		// $sql = 'select distinct ' . $level . ' from shop_attrtmp';
		// $result = $model -> query($sql);
		// foreach ($result as $key => $value) {
		// $category -> Pid = 0;
		// $category -> Name = $value[$level];
		// $prev = $value[$level];
		// $id = $category -> add();
		// }
		//
		// foreach ($result as $key => $value) {
		// $level = "level" . $categoryId[1];
		// $sql = 'select distinct ' . $level . ' from shop_attrtmp where level' . $categoryId[0] . '="' . $prev . '"';
		// $result = $model -> query($sql);
		// foreach ($result as $key => $value) {
		// $category -> Pid = $id;
		// $category -> Name = $value[$level];
		// $category -> add();
		// }
		// }

		// //商品总数
		// $sql = "select count(productid) from shop_attrtmp where level197='Sunglasses' and level198='Rectangle' and level199='Lifestyle';";
		// $count = $model -> query($sql);
		// //echo $category -> getLastsql();
		// if ($id) {
		// $result = $model -> query("drop table shop_attrtmp");
		// if ($result) {
		// $this -> success("Ok");
		// }
		// }
		// //执行完删除drop table shop_tmptable;
		// foreach ($array as $key => $value) {
		// $map['TypeAttrId'] = array("in", $value);
		// $list = $productattr -> distinct(TRUE) -> where($map) -> getField("AttrValue", TRUE);
		// //print_r($list);
		// //echo "\n";
		// }
		// foreach ($list as $key => $value) {
		// $data = $productattr -> distinct(TRUE) -> where("TypeAttrId=" . $value) -> getField("AttrValue", TRUE);
		// foreach ($data as $key => $value) {
		// $category -> Name = $value;
		// $category -> Id = $list;
		// $category -> add();
		// }
		// }
	}

	public function call_proccess() {
		foreach ($result as $key => $value) {
			$level = "level" . $categoryId[1];
			$sql = 'select distinct ' . $level . ' from shop_attrtmp where level' . $categoryId[0] . '="' . $prev . '"';
			$result = $model -> query($sql);
			foreach ($result as $key => $value) {
				$category -> Pid = $id;
				$category -> Name = $value[$level];
				$category -> add();
			}
		}
	}

	public function addCategory1() {
		$category = D("Category");
		//通过传递过来的属性名查询值得
		$array = $this -> _post('category');
		$category -> create();
		foreach ($array as $key => $value) {
			$category -> Name = $value;
			$list[] = $category -> add();
		}
		$map['Id'] = array('in', $list);
		$data = $category -> where($map) -> getField("Id,Name");
		//print_r($data);
		if ($data) {
			$this -> ajaxReturn($data, "创建成功", 1);
		} else {
			$this -> error($category -> getLastsql());
		}
	}

}
?>