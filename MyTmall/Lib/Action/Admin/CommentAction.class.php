<?php
/**
 * 商品评论控制器
 * 日期:2013-03-29
 * 作者:邱银乐
 */
import("ORG.Util.Page");
class CommentAction extends Action {
	public function insert() {
		$comment = D("Productcomment");
		$comment -> create();
		if ($comment -> add()) {
			$this -> ajaxReturn(null, "感谢参与", 1);
		} else {
			$this -> error("评论失败");
		}
	}

	public function showComment() {
		$comment = D("Productcomment");
		$map['Product_id'] = $this -> _post('id');
		$count = $comment -> where($map) -> count();
		$page = new Page($count, 25);
		$list = $comment -> where($map) -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		if ($list) {
			$list["page"] = $page -> show();
			$this -> ajaxReturn($list, "暂无评论", 1);
		} else {
			$this -> error("暂无评论");
		}
	}

}
?>