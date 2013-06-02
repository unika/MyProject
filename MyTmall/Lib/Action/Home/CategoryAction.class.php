<?php
/**
 * 购物车模块
 */

class CategoryAction extends Action {
	public function index() {
		echo "abc";
	}

	//执行前端的空操作,利于seo
	public function _empty() {
		import("ORG.Util.Page");
		$name = ACTION_NAME;
		$map['Name'] = array('like', $name);
		$category = D("Category");
		$aggregate = D("Productaggregate");
		//获取分类id;
		$cid = $category -> where($map) -> getField("Id");
		$where['Pid'] = $cid;
		//获取分类子类
		$subcat = $category -> where($where) -> getField("Id,Name,Pid", TRUE);

		//$subcat = arrayPidProcess($data, $res, $cid, 0);
		foreach ($subcat as $key => $value) {
			$plist[] = $value['Id'];
		}
		//获取分类下的全部子类产品id
		$map['CategroyId'] = array('in', $plist);
		$productlist = $aggregate -> where($map) -> getField("ProductId", TRUE);
		//获取分类下的全部子类产品id
		$condition['Id'] = array('in', $productlist);
		$product = D("Product");
		$count = $product -> where($condition) -> count();
		$page = New Page($count, 25);
		$result = $product -> where($condition) -> limit($page -> firstRow, $page -> listRows) -> getProduct();
		$page -> setConfig('header', '条记录');
		$page -> setConfig('prev', '上一页');
		$page -> setConfig('next', '下一页');
		$page -> setConfig('first', '第一页');
		$page -> setConfig('last', '最后一页');
		$page -> setConfig('theme', ' %totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%');
		$show = $page -> show();
		$this -> assign("subcat", $subcat);
		$this -> assign('result', $result);
		$this -> assign('page', $show);
		$this -> display("index");
	}

	public function serach() {
		//复合查询要新建一个条件$where,['_logic']表示是什么样的逻辑and,or,然后用  $map['_complex']并如$map条件来查询
		$where = 'SELECT id, attrValue,Name,Price FROM shop_product WHERE attrValue like "%';
		$sql = implode('%" and attrValue like "%', $_POST);
		$where .= $sql . '%"';
		$product = D("Product");
		$list = $product -> query($where);
		$image = M("Productimg");
		foreach ($list as $key => $value) {
			$img = $image -> field('Img') -> where('UseType=1 and ProductId=' . $value['id']) -> find();
			$list[$key]['Img'] = $img;
		}
		//	print_r($list);
		$count = count($list);
		if ($list) {
			$this -> ajaxReturn($list, '', 1);
		} else {
			$this -> error("无法查询到符合条件的产品");
		}

	}

}
?>