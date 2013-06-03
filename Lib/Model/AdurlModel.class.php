<?php
/**
 * 文件:广告模型
 * 日期:2013-03-26
 * 作者:邱银乐
 */
class AdurlModel extends Model {
	protected $_auto = array(//自动填充
	array('add_time', 'fill_date', 1, 'callback'), //填充添加时间
	array('update_time', 'fill_date', 3, 'callback'), //填充更新时间
	);
	protected $_validate = array(//自动验证
	array('Name', 'require', '广告名称必须'), //
	array('image', 'require', '广告图片未上传'), //
	array('Url', 'require', '广告链接必须'), //
	array('start_time', 'require', '广告开始时间必须'), //
	array('end_time', 'require', '广告结束时间必须'), //
	);

	public function fill_date() {
		$AddTime = date("Y-m-d H:i:s");
		return $AddTime;
	}

	public function filter_list() {
		$list = $this -> select();
		$adclick = D("Adclick");
		foreach ($list as $key => $value) {
			$now = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$start_time = strtotime($value['start_time']);
			$end_time = strtotime($value['end_time']);
			$start_time = mktime(0, 0, 0, date("m", $start_time), date("d", $start_time), date("Y", $start_time));
			$end_time = mktime(0, 0, 0, date("m", $end_time), date("d", $end_time), date("Y", $end_time));
			$list[$key]['valid'] = $this -> checkValid($now, $start_time, $end_time);
			$list[$key]['click'] = $adclick -> where('ImgNo=' . $value['id']) -> Count();
			//计算广告点击量
		}
		return $list;
	}

	public function filter_Ad() {
		$list = $this -> select();
		foreach ($list as $key => $value) {
			$now = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$start_time = strtotime($value['start_time']);
			$end_time = strtotime($value['end_time']);
			$start_time = mktime(0, 0, 0, date("m", $start_time), date("d", $start_time), date("Y", $start_time));
			$end_time = mktime(0, 0, 0, date("m", $end_time), date("d", $end_time), date("Y", $end_time));
			$list[$key]['valid'] = $this -> checkValid($now, $start_time, $end_time);
			//计算广告点击量
		}
		return $list;
	}

	//检查状态
	public function checkValid($now, $start_time, $end_time) {
		if ($now < $start_time) {
			return 0;
			//未开始;
		} else if ($now >= $start_time && $now < $end_time) {
			return 1;
			//进行中;
		} else {
			return 2;
			//已结束;
		}
	}

}
?>