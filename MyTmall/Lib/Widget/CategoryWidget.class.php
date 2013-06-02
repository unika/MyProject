<?php
/**
 * 文件:广告挂件Adwidget
 * 功能:统计文告点击效果
 * 日期:2013-04-27
 * 作者：邱银乐
 */
class CategoryWidget extends Widget {
	public function render($data) {
		$category = D("Category");
		$list = $category -> getField("Id,Name,Pid", TRUE);
		$data['category'] = arrayPidProcess($list, $res, '0', '0');
		//尾数0,可以控制层数
		$content = $this -> renderFile('Category', $data);
		return $content;
	}

}
?>