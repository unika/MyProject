<?php
/**
 * 商品评论控制器
 * 日期:2013-03-29
 * 作者:邱银乐
 */
class CommentAction extends Action {
	public function insert() {
		$comment = D("Productcomment");
		$comment -> create();
		if ($comment -> add()) {
			$info = "感谢参与";
			$this -> ajaxReturn(null, $info, 1);
		} else {
			$this -> error($comment -> getError());
		}
	}

	public function showComment() {
		$comment = D("Productcomment");
		$map['ProductId'] = $_POST['id'];
		$count = $comment -> where($map) -> select();
		$page = new Page($count, 25);
		$list = $comment -> where($map) -> limit($page -> firstRow . ',' . $page -> lastRows) -> select();
		$show = $page -> show();
		print_r($list);

	}

}
?>