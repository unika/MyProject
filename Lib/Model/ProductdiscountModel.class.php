<?php
/**
 * 文件:广告模型
 * 日期:2013-03-26
 * 作者:邱银乐
 */
class ProductdiscountModel extends Model {
protected $_auto=array(//自动填充
array('add_time','fill_date',1,'callback'),//填充添加时间
array('update_time','fill_date',3,'callback'), //填充更新时间
);
public function fill_date() {
$AddTime=date("Y-m-d H:i:s");
return $AddTime;
}
public function filter_list() {
$list=$this->field("add_time,update_time",TRUE)->select();
$temp=D("Discounttemp");
$template=D("Templateku");
foreach($list as $key=>$value) {
$now=mktime(date("s"),date("i"),date("h"),date("m"),date("d"),date("Y"));
$start_time=strtotime($value['start_time']);
$end_time=strtotime($value['end_time']);
$start_time=mktime(date("s",$start_time),date("i",$start_time),date("h",$start_time),date("m",$start_time),date("d",$start_time),date("Y",$start_time));
$end_time=mktime(date("s",$end_time),date("i",$end_time),date("h",$end_time),date("m",$end_time),date("d",$end_time),date("Y",$end_time));
$list[$key]['valid']=$this->checkValid($now,$start_time,$end_time);
$tempid=$temp->where("discountid=".$value['id'])->getField("tempid");
$list[$key]['tempinfo']=$template->field("PicPath,FilePath,Html",TRUE)->where("id=".$tempid)->find();
}
return $list;
}
//检查状态
public function checkValid($now,$start_time,$end_time) {
if($now<$start_time) {
return 0;
//未开始;
} else if($now>=$start_time&&$now<$end_time) {
return 1;
//进行中;
} else {
return 2;
//已结束;
}
}
public function filterDiscount() {
$list=$this->select();
foreach($list as $key=>$value) {
$now=mktime(date("s"),date("i"),date("h"),date("m"),date("d"),date("Y"));
$start_time=strtotime($value['start_time']);
$end_time=strtotime($value['end_time']);
$start_time=mktime(date("s",$start_time),date("i",$start_time),date("h",$start_time),date("m",$start_time),date("d",$start_time),date("Y",$start_time));
$end_time=mktime(date("s",$end_time),date("i",$end_time),date("h",$end_time),date("m",$end_time),date("d",$end_time),date("Y",$end_time));
$result=$this->checkValid($now,$start_time,$end_time);
if($result==2) {
unset($list[$key]);
}
}
return $list;
}
//$Pid为要移除的产品id
public function remove($Productid) {
$result=$this->find();
$array=json_decode($result['Productid'],TRUE);
$key=array_search($Productid,$array);
unset($array[$key]);
return $this->where('id='.$result['id'])->setField("Productid",json_encode(array_values($array)));
}
}
?>