<?php
/**
 * 文件:营销管理
 * 功能：网站专题活动管理，增删改，活动单页模板管理,电子优惠券管理
 * 作者:邱银乐
 * 日期:2013-03-26
 */
import("ORG.Util.Page");
class DiscountAction extends Action {
public function index() {
$discount=D("Productdiscount");
$count=$discount->count();
$page=new Page($count,25);
$show=$page->show();
$list=$discount->order("add_time desc")->limit($page->firstRow.','.$page->listRows)->filter_list();
$this->assign('list',$list);
$this->display();
}
public function _before_add() {
$type=D("Producttype");
$data=$type->select();
$typelist=arrayPidProcess($data,$res,'0','0');
$typeTree=$type->getTypetree('-',$typelist);
$this->assign("typeTree",$typeTree);
}
public function getDiscount() {
$discount=D("Productdiscount");
$map['type']=$this->_post("type");
$data=$discount->field("Productid,add_time,update_time",TRUE)->where($map)->filterDiscount();
//print_r($data);
if($data) {
$this->ajaxReturn($data,'',1);
} else {
$this->error("没有可选活动");
}
}
public function getTypelist() {
//产品类型
$type=D("Producttype");
$data=$type->select();
$typelist=arrayPidProcess($data,$res,'0','0');
$typeTree=$type->getTypetree('-',$typelist);
return $typeTree;
}
/**************************活动产品列表*************************************/
public function product() {
$discountid=$this->_get("id");
$product=D("Product");
$count=$product->where($map)->count();
$page=New Page($count,25);
$show=$page->show();
$list=$product->where($map)->limit($page->firstRow.','.$page->listRows)->getProduct();
$this->assign("discountid",$discountid);
$this->assign('data',$this->getTypelist());
$this->assign("page",$show);
$this->assign("list",$list);
$this->display();
}
public function getProduct() {
//产品类型
$map["ProductTypeId"]=$_POST['ProductTypeId'];
$product=D("Product");
$count=$product->where($map)->count();
$page=New Page($count,15);
$field="id,Name,Price,ProductImgId,DbNum,Status";
$show=$page->show();
$list=$product->field($field)->where($map)->limit($page->firstRow.','.$page->listRows)->getProduct();
$data=array("page"=>$show,"result"=>$list,);
if($list) {
$this->ajaxReturn($list,'产品信息列表',1);
} else {
$this->error("此类型下无产品");
}
}
public function del() {
$map['id']=$_POST['id'];
$discount=D("Productdiscount");
if($discount->where($map)->delete()) {
$this->success("活动删除成功");
} else {
$this->error("活动删除失败");
}
}
public function insert() {
$discount=D("Productdiscount");
$discount->create();
if($id=$discount->add()) {
$data=$discount->field("add_time,update_time",ture)->find($id);
$this->ajaxReturn($data,"活动添加成功",1);
} else {
$this->error("活动添加失败");
}
}
//**************************************活动产品相关************************************************
public function addProduct() {
$map['id']=$this->_post('id');
$discount=D("Productdiscount");
$productid=$this->_post('Productid');
$action=$this->_post('action');
$data=$discount->where($map)->find();
if($data['Productid']=="null") {
$array=array($productid);
} else {
$array=json_decode($data['Productid'],TRUE);
array_push($array,$productid);
}
$result=$discount->where($map)->setField('Productid',json_encode(array_values($array)));
if($result) {
$this->success("添加成功");
} else {
$this->error("添加失败");
}
}
public function delProduct() {
$map['id']=$this->_post('id');
$discount=D("Productdiscount");
$Productid=$this->_post('Productid');
$result=$discount->where($map)->remove($Productid);
if($result!==false) {
$this->success('删除成功');
} else {
$this->error($discount->getLastsql());
}
}
public function viewProduct() {
$map['id']=$this->_post('id');
$discount=D("Productdiscount");
$product=D("Product");
$list=$discount->field("id,Productid")->where($map)->find();
$pid=json_decode($list['Productid']);
$field="id,Name,Price,ProductImgId,DbNum,Status";
foreach($pid as $key=>$value) {
$data[$key]=$product->field($field)->where("id=".$value)->getinfo();
}
if($data) {
$this->ajaxReturn($data,'',1);
} else {
$this->error('本活动下还未有产品');
}
}
//****************************************优惠券********************************************************
public function delCoupon() {
$map['Id']=$this->_post("id");
$coupon=D("Coupon");
if($coupon->where($map)->delete()) {
$this->success("优惠券删除成功");
} else {
$this->error("优惠券删除失败");
}
}
//添加生成优惠券
public function addCoupon() {
$coupon=D("Coupon");
$couponName=$this->_post("couponName");
$num=$this->_post('num');
$Price=$this->_post('Price');
$ExpireTime=$this->_post('end_time');
$IsDiscount=$this->_post('IsDiscount');
for($i=0;$i<$num;$i++) {
$coupon->No=$Price.'-'.rand_uniqid(time()).'-'.randstr();
$coupon->Price=$Price;
$coupon->Status=1;
$coupon->ExpireTime=$ExpireTime;
$coupon->IsDiscount=$IsDiscount;
$id=$coupon->add();
sleep(1);
}
if($id) {
$this->success("优惠券添加成功");
} else {
$this->error("优惠券添加失败");
}
}
//优惠券列表
public function coupon() {
$coupon=D("Coupon");
$count=$coupon->count();
$page=new Page($count,25);
$list=$coupon->order("ExpireTime desc,id desc")->limit($page->firstRow.','.$page->listRows)->select();
$this->assign("page",$page->show());
$this->assign("list",$list);
$this->display();
}
//****************************************优惠券********************************************************
//活动单页模板管理
public function template() {
$template=D("Templateku");
$count=$template->count();
$page=new Page($count,25);
$field="Id,Type,Name,Designer,Image";
$list=$template->order("id desc")->field($field)->limit($page->firstRow.','.$page->listRows)->select();
$this->assign("page",$page->show());
$this->assign("list",$list);
$this->display();
}
public function getTemplate() {
$template=D("Templateku");
$field="Id,Type,Name,Designer,Image";
$list=$template->field($field)->select();
if($list) {
$this->ajaxReturn($list,'',1);
} else {
$this->error("暂无模板信息");
}
}
//为活动选择模板
public function chooseTemplate() {
//如果有记录就更新,没有就添加
$discounttemp=D("Discounttemp");
$map['discountid']=$this->_post("discountid");
$list=$discounttemp->where($map)->find();
if($list) {
$data['tempid']=$this->_post("tempid");
$reuslt=$discounttemp->where($map)->save($data);
} else {
$discounttemp->create();
$reuslt=$discounttemp->add();
}
if($reuslt!==false) {
$this->success("活动模版选定成功");
} else {
$this->error("未能更换活动模板");
}
}
public function addTemplate() {
$template=D("Templateku");
$template->create();
$template->Name=$this->_post("Name");
$template->Html=$this->_post("Content");
$template->Image=$this->_post("image");
file_put_contents(HTML_PATH.$template->Name.".html",html_entity_decode($template->Html));
if($id=$template->add()) {
$field="Id,Type,Name,Designer,Image";
$list=$template->field($field,TRUE)->find($id);
$this->ajaxReturn($list,"活动模板添加成功",1);
} else {
$this->error("活动模板添加失败");
}
}
public function delTemplate() {
//删除数据库里记录,并删除模板文件
$map['Id']=$this->_post("Id");
$template=D("Templateku");
$filename=$template->where($map)->getField("Name");
if($template->where($map)->delete()) {
unlink(HTML_PATH.$filename.'.html');
$this->success("模板删除成功");
} else {
$this->error("模板删除失败");
}
}
//编辑
public function editTemplate() {
$map['Id']=$this->_post("Id");
$template=D("Templateku");
$list=$template->where($map)->find();
$list['Html']=file_get_contents(HTML_PATH.$list['Name'].'.html');
if($list) {
$this->ajaxReturn($list,'',1);
} else {
$this->error("无此模板信息");
}
}
//更新模板
public function updateTemplate() {
$map['Id']=$this->_post("Id");
$template=D("Templateku");
$template->create();
$template->Html=$this->_post("Content");
$filename=$template->where($map)->getField("Name");
file_put_contents(HTML_PATH.$filename.".html",html_entity_decode($template->Html));
if($_POST['image']) {
$template->Image=$this->_post("image");
}
if($template->where($map)->save()!=FALSE) {
$this->success("更新成功");
} else {
$this->error($template->getLastsql());
$this->error("更新失败");
}
}
//预览活动
public function preview() {
$discount=D("Productdiscount");
$template=D("Templateku");
$product=D("Product");
$data=$discount->where('id='.$this->_post('id'))->getField("Productid");
$map['Id']=array('in',json_decode($data,TRUE));
$list=$product->where($map)->select();
$filename=$template->where("id=".$this->_post('tmp_id'))->getField("Name");
if($list) {
$this->assign("list",$list);
$content=$this->fetch(HTML_PATH.$filename.'.html');
$this->ajaxReturn($content,'',1);
} else {
$this->error("无产品");
}
}
//预浏摸板功能
public function viewTemplate() {
$map['Id']=$this->_post("Id");
$template=D("Templateku");
$list=$template->where($map)->find();
$filename=$template->where($map)->getField("Name");
if($list) {
$this->assign("name",$name);
$content=$this->fetch(HTML_PATH.$filename.".html");
$this->ajaxReturn($content,'',1);
} else {
$this->error("无此模板");
}
}
public function uploadTofile() {
$upload=new UploadAction('./Upload/'.MODULE_NAME.'/','uniqid','/Upload/'.MODULE_NAME.'/');
$upload->ajaxupload();
}
}
?>