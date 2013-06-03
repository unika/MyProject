<?php
/*
 *
 * 文件名:商品操作控制器
 * 日期:2013-03-24
 * 作者:邱银乐
 *
 */
class ProductAction extends Action {
	public function index() {
		import("ORG.Util.Page");

		$product = D("Product");
		$count = $product -> count();
		$page = new Page($count, 25);
		$show = $page -> show();
		$list = $product -> order("Id desc,AddTime desc") -> limit($page -> firstRow . ',' . $page -> listRows) -> getProduct();
	
		$this -> assign("list", $list);
		$this -> assign("page", $show);
		$this -> display();
	}

	// public function _before_edit() {
	// $map['Id'] = $_GET['Id'];
	// $product = D("Product");
	// //产品信息
	// $type = D("Producttype");
	// //产品类型
	// $data = $type -> select();
	// $typelist = arrayPidProcess($data, $res, '0', '0');
	// $field = "shop_Product.id as id, shop_Productimg.id as imgid, shop_Product.Name as product_name,shop_Producttype.id as typeid,";
	// $field .= "shop_Producttype.name as Type_name,Status,DbNum,Des, Img, Price, ProductImgId, ProductTypeId, AddTime, Status, MarketPrice,";
	// $field .= "Page_Title, Page_Keyword, Page_Description, Page_Url, SerialIden";
	// $list = $product -> field($field) -> join("shop_Productimg on shop_Product.id=ProductId") -> join("shop_Producttype on shop_Product.ProductTypeId=shop_Producttype.id") -> where($map) -> find();
	// $list['AttrValue'] = json_decode($list['AttrValue'], TRUE);
	// $typeTree = $type -> selectType('-', $typelist, $list['typeid']);
	// $this -> assign('typeTree', $typeTree);
	// $this -> assign($list);
	// }

	public function getlist1() {//产品信息
		$type = D("Producttype");
		//产品类型
		$data = $type -> select();
		$typelist = arrayPidProcess($data, $res, '0', '0');
		$typeTree = $type -> getTypetree('-', $typelist);
		$data = array("tree" => $typeTree);

		if ($data) {
			$this -> ajaxReturn($data, $info, 1);
		} else {
			$this -> ajaxReturn(null, "无此商品", 0);
		}

	}

	public function getSelectType() {//产品信息
		$ProductTypeId = $_POST['ProductTypeId'];
		$type = D("Producttype");
		//产品类型
		$data = $type -> select();
		$typelist = arrayPidProcess($data, $res, '0', '0');
		$typeTree = $type -> selectTypetree('-', $typelist);
		$data = array("tree" => $typeTree);
		if ($data) {
			$this -> ajaxReturn($data, $info, 1);
		} else {
			$this -> ajaxReturn(null, "无此商品", 0);
		}

	}

	public function getlist() {
		$map['Id'] = $this -> _post('Id');
		$product = D("Product");
		//产品信息
		$type = D("Producttype");
		//产品类型
		$data = $type -> select();
		$typelist = arrayPidProcess($data, $res, '0', '0');
		$list = $product -> where($map) -> getinfo();
		$typeTree = $type -> selectType('-', $typelist, $list['ProductTypeId']);
		$list['typetree'] = $typeTree;
		if ($list) {
			$this -> ajaxReturn($list, $info, 1);
		} else {
			$this -> ajaxReturn(null, "无此商品", 0);
		}

	}

	//更新产品信息
	public function update() {
		$product = D("Product");
		$image = D("Productimg");
		$product -> create();
		$product -> AttrValue = json_encode($_POST['attr']);
		if ($product -> save() != false) {
			$this -> success("更新成功");
		} else {
			$this -> error("更新失败");

		}
	}

	public function insert() {
		$product = D("Product");
		$image = D("Productimg");
		if ($product -> create()) {
			$product -> AttrValue = json_encode($_POST['attr']);
			if ($id = $product -> add()) {
				//如果用户添加产品时并上传了图片,将默认为主图
				if ($_POST['image']) {
					$image -> ProductId = $id;
					$image -> Img = $_POST['image'];
					$image -> UseType = 1;
					$image -> add();
				}
				$field = "AddTime,AttrValue,CatId,DbNum,DefineProductComment_Id,Des,Id,KuPId,MarketPrice,Name,Price";
				$list = $product -> field($field) -> where("Id=" . $id) -> getinfo();
				if ($list) {
					$this -> ajaxReturn($list, "产品添加成功", 1);
				} else {
					$this -> error($product -> getError());
				}

			} else {
				$this -> error("产品添加失败");
			}
		} else {
			$this -> error($product -> getError());
		}

	}

	public function del() {
		$map['Id'] = $_POST['id'];
		$product = M('Product');
		if ($product -> where($map) -> delete()) {
			$this -> success("数据删除成功");
		} else {
			$this -> error("数据删除失败");
		}
	}

	//更改商品在售status状态
	public function changeStatus() {
		$map['Id'] = $_POST['Id'];
		$img = M('Product');
		if ($_POST['action'] === 'up') {
			$data['Status'] = 1;
		} else if ($_POST['action'] === 'down') {
			$data['Status'] = 0;
		}
		if ($img -> where($map) -> save($data) === false) {
			$this -> error('状态改变失败');
		} else {
			$this -> ajaxReturn($data['Status'], '', 1);
		}
	}

	//更改为ajax分页
	public function addImg() {
		$img = D("Productimg");
		$img -> create();
		if ($img -> add()) {
			$this -> success('图片添加成功');
		} else {
			$this -> error('图片添加失败');
		}
	}

	public function viewImg() {
		$map['ProductId'] = $this -> _post('ProductId');
		$img = M("Productimg");
		$list = $img -> where($map) -> select();
		if ($list) {
			$this -> ajaxReturn($list, '', 1);
		} else {
			$this -> error("暂无图片");
		}

	}

	public function updateImg() {
		$map['ProductId'] = $_POST['ProductId'];
		$id = $_POST['Id'];
		$img = M("Productimg");
		if ($img -> where($map) -> data('UseType=0') -> save() !== false) {
			if ($img -> where('Id=' . $id) -> data('UseType=1') -> save()) {
				$this -> success("主图设置成功");
			}
		} else {
			$this -> error("无此产品图片");
		}
	}

	//删除图片
	public function delImg() {
		$map['Id'] = $_POST['Id'];
		$img = M("Productimg");
		if ($img -> where($map) -> delete()) {
			//删除主图包括主图及副图
			$filename = $img -> where($map) -> getField("Img");
			$arry = explode(',', C('thumbPrefix'));
			if ($arr) {
				foreach ($arr as $key => $value) {
					unlink("./Upload/Product/" . $value . $filename);
				}
			}
			unlink("./Upload/Product/" . $filename);
			$this -> success("删除成功");
		} else {
			$this -> error("删除失败");
		}
	}

	//设置主土和模特图片.通过action判断,亦可更改其他方式
	public function setImg() {
		$map['Id'] = $_POST['Id'];
		$img = M('Productimg');
		if ($_POST['action'] === 'model') {
			$data['UseType'] = 2;
		} else if ($_POST['action'] === 'main') {
			$data['UseType'] = 1;
		}
		if ($img -> where($map) -> save($data) != false) {
			$this -> ajaxReturn($data['UseType'], '', 1);
		} else {
			$this -> error('设置失败');
		}
	}

	//设置图片的排序.
	public function setImgOrder() {
		$map['Id'] = $_GET['Id'];
		$img = M('Productimg');
		$data['ImagOrder'] = $_GET['ImagOrder'];
		if ($img -> where($map) -> save($data) != false) {
			$this -> success('图片排序设置成功');
		} else {
			$this -> error('no');
		}
	}

	//复制产品
	public function copyProduct() {
		$id = $_POST['Id'];
		$product = D("Product");
		$Img = D("Productimg");
		$data = $product -> copyToNew($id);
		if ($id = $product -> add($data)) {
			$field = "Img,KuPId,MarketPrice,Page_Description,Page_Keyword,Page_Title,Page_Url,AttrValue,CatId,Des,UpdateTime";
			foreach ($data['Img'] as $key => $value) {
				unset($value['Id']);
				$value['ProductId'] = $id;
				$data['Img'][$key] = $value;
				$Img -> add($value);
				//没有拷贝图像文件,只拷贝了数据库字段
			}
			$data = $product -> field($field, TRUE) -> where('Id=' . $id) -> getInfo();
			$this -> ajaxReturn($data, "产品复制成功", 1);
		} else {
			$this -> error("产品复制失败");
		}
	}

	//显示针对某一个商品评论;
	public function showComment() {
		$productId = $_POST['productId'];
		$comment = D("Productcomment");
		$listComment = $comment -> findAll($productId);
		print_r($listComment);
	}

	public function viewAttr() {
		$map['id'] = $_POST['id'];
		$product = D("Product");
		$list = $product -> field("id,Name,AttrValue") -> where($map) -> find();
		$list['AttrValue'] = json_decode($list['AttrValue']);
		if ($list) {
			$this -> ajaxReturn($list, '', 1);
		} else {
			$this -> error("此产品暂无属性");
		}
	}

	public function uploadfile() {
		//$upload = new UploadAction('./Upload/Product/', 'uniqid', '/Upload/Product/');
		$upload = new UploadAction('./Upload/' . MODULE_NAME . '/', 'uniqid', '/Upload/' . MODULE_NAME . '/');
		$upload -> imagewater = C("water");
		if (C("alpha")) {
			$upload -> alpha = C("alpha");
		}
		$upload -> watername = C("image");
		$upload -> thumb = C("thumb");
		$upload -> thumbMaxWidth = C("thumbMaxWidth");
		$upload -> thumbMaxHeight = C("thumbMaxHeight");
		$upload -> thumbPrefix = C("thumbPrefix");
		$upload -> ajaxupload();
	}

	public function uploadTofile() {
		$upload = new UploadAction('./Upload/Product/', 'uniqid', '/Upload/Product/');
		$upload -> imagewater = C("water");
		if (C("alpha")) {
			$upload -> alpha = C("alpha");
		}
		$upload -> watername = C("image");
		$upload -> thumb = C("thumb");
		$upload -> thumbMaxWidth = C("thumbMaxWidth");
		$upload -> thumbMaxHeight = C("thumbMaxHeight");
		$upload -> thumbPrefix = C("thumbPrefix");
		$data = $upload -> ajaxToupload();
		$fullname = $data['fullname'];
		$filename = $data['filename'];
		$img = D("Productimg");
		$img -> create();
		$img -> ProductId = $_POST['ProductId'];
		$img -> Img = $filename;

		if ($id = $img -> add()) {
			echo '<script src="/Public/Js/jquery.js" type="text/javascript"></script>';
			echo '<script>';
			$html = "<tr>";
			$html .= "<td>" . $id . "</td>";
			$html .= "<td>;";
			$html .= "<img style='width:100px;height:100px;' src='" . $fullname . "' />";
			$html .= "</td>;";
			$html .= "<td class='useType'>是</td>";
			$html .= "<td>;";
			$html .= "<input class='main' type='radio' aid='" . $id . "''> 主图 |";
			$html .= "<span class='del' aid='" . $id . "'>删除</span>";
			$html .= "</td>";
			$html .= "</tr>";
			echo '$("#imglist",window.parent.document).find("tr:first").after("' . $html . '");';
			echo 'alert("上传成功")';
			echo "</script>";
		} else {
			echo '<script>';
			echo 'alert("上传失败")';
			echo "</script>";
		}

	}

}
?>