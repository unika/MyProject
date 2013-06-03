<?php
class DataSyncAction extends Action {
	public function _empty() {
		$this -> api(ACTION_NAME);
	}

	public function api($api) {
		switch ($api) {
			//远程推送产品数据
			case 'Product_Sync' :
				$this -> Product();
				break;
			//远程推送产品类型数据
			case 'ProductType_Sync' :
				$this -> ProductType();
				break;
			//远程推送产品属性数据
			case 'ProductTypeAttr_Sync' :
				$this -> ProductTypeAttr();
				break;
			//本地获取远程产品数据数据
			case 'getProduct' :
				$this -> getProduct();
				break;
			//本地获取远程产品类型数据
			case 'getProductType' :
				$this -> getProductType();
				break;
			//本地获取远程产品属性数据
			case 'getProductTypeAttr' :
				$this -> getProductTypeAttr();
				break;
		}
	}

	//远程异步获取产品
	public function Product() {
		/****** 三个键值
		 //productJson
		 //productAttrValueJson
		 //productImgJson
		 **/
		$handle = fopen("d:/Product_Sync.txt", 'a+');
		$product = D("Product");
		$attrvalue = D("Attrvalue");
		$img = D("Productimg");
		$productattrvalue = D("Productattrvalue");
		$product -> create();
		$attrvalue -> create();
		$img -> create();
		$productattrvalue -> create();
		$array1 = json_decode($_POST['productJson'], TRUE);
		$array2 = json_decode($_POST['productImgJson'], TRUE);
		$array3 = json_decode($_POST['productAttrValueJson'], TRUE);
		//图片id
		$array1['ProductImgId'] = $array1['ProductImg']['Id'];
		//类型id
		$array1['ProductTypeId'] = $array1['ProductType']['Id'];
		//******************************************产品属性序列化开始**********************//
		foreach ($array1 as $key => $value) {
			if ($key == 'AttrValue') {
				$pattrValue = $this -> strTojson("|", $value);
			}
		}
		//******************************************产品属性序列化结束**********************//

		//******************************************属性序列化结束**********************//
		$array1['AttrValue'] = $pattrValue;
		fwrite($handle, $array1['AttrValue']);
		if ($id = $product -> add($array1)) {
			$img -> ProductId = $id;
			foreach ($array2 as $value) {
				$img -> add($value);
			}
			foreach ($array3 as $value) {
				$value['ProductId'] = $id;
				$value['TypeAttrId'] = $value['TypeAttr']['Id'];
				$productattrvalue -> add($value);
			}
		}
		// fwrite($handle, $_POST['productJson']);
		// fwrite($handle, $_POST['productAttrValueJson']);
		fclose($handle);
	}

	//远程异步获取类型
	public function ProductType() {
		$type = D("Producttype");
		//同步先删除,后插入;
		//或者先清空表,然后重至
		$handle = fopen("d:/ProductType_Sync.txt", 'a+');
		$array1 = json_decode($_POST['ProductTypeJson'], TRUE);
		$type -> create();
		$type -> delete();
		foreach ($array1 as $key => $value) {
			$type -> add($value);
		}
		fwrite($handle, $_POST['ProductTypeJson']);
		fclose($handle);
		//重定向到abc.php;
		$this -> redirect("../../message.php");

	}

	public function ProductTypeAttr() {
		$TypeAttr = D("Attrvalue");
		$TypeAttr -> create();
		$handle = fopen("d:/ProductTypeAttr_Sync.txt", 'a+');
		if ($handle) {
			foreach ($_POST as $key => $value) {
				fwrite($handle, $key . "\n");

			}
		}
		$ProductId = $_POST['typeId'];
		$array = json_decode($_POST['ProductTypeAttrJson'], TRUE);

		foreach ($array as $key => $value) {
			$value['ProductTypeId'] = $ProductId;
			$TypeAttr -> add($value);
		}

		fclose($handle);
		$this -> redirect("../../message.php");
	}

	function xmltoarray($string) {
		$xml = simplexml_load_string($string);
		foreach ($xml->children() as $key => $value) {
			$data['name'][] = $value['name'];
			$data['value'][] = $value['value'];
			//$data[]['value'] = $value['value'];
			fwrite($handle, $value['name']);
			//
			fwrite($handle, $value['value']);

		}
		return $data;
	}

	//字符转json
	function strTojson($demiter, $str) {
		$arr = explode($demiter, $str);
		foreach ($arr as $key => $value) {
			list($keys, $key_value) = explode(":", $value);
			$data[$keys][] = $key_value;
		}
		return json_encode($data);
	}

	//获取属性名
	function getAttrKey($demiter, $str) {
		$arr = explode($demiter, $str);
		foreach ($arr as $key => $value) {
			list($key, $value) = explode(":", $value);
			$data[$key] = $value;
		}
		return $data;
	}

}
?>