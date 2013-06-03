<?php
/**
 * 文件:广告挂件Adwidget
 * 功能:统计文告点击效果
 * 日期:2013-04-27
 * 修改日期 2013-05-31
 * 作者：邱银乐
 * {:W("Ad",array('count'=>12,'Id'=>25,'display'=>'Index','adtype'=>'banner','adsize'=>'width:200,height:100','order'=>'desc'))}
 * count为一次几条数据,Id为推荐类型Id,可以在后台查看,display决定调用用那个摸板文件来渲染,注意模板名大小写,
 * adtype广告类型,adsize广告尺寸,order为未排序,如不填默认为升序,
 */

class AdShowWidget extends Widget {
	public function render($data) {
		$ad = D("Adurl");
		$field = 'id,image,url,start_time,end_time,adtype,adsize';
		$map['adtype'] = $data['adtype'] ? $data['adtype'] : "banner";
		$map['adsize'] = $data['adsize'] ? $data['adsize'] : "720*180";
		$data['ad'] = $ad -> field($field) -> where($map) -> limit($data['count']) -> filter_Ad();
	
		print_r($data['ad']);
		$content = $this -> renderFile($data['display'], $data);
		return $content;
	}

}
?>