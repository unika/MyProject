<?php
/**
 * 广告管理模块
 */
import("ORG.Util.Page");
class AdmanagerAction extends Action {
public function index() {
$adurl=D("Adurl");
$count=$adurl->count();
$page=new Page($count,20);
$show=$page->show();
$list=$adurl->limit($page->firstRow.','.$page->listRows)->filter_list();
$this->assign("page",$show);
$this->assign("list",$list);
$this->display();
}
public function insert() {
$adUrl=D("Adurl");
if($adUrl->create()) {
if($adUrl->add()) {
$this->success("广告添加成功");
} else {
$this->error("广告添加失败");
}
} else {
$this->error($adUrl->getError());
}
}
public function adClick() {
$adclick=D("Adclick");
$adclick->create();
$adclick->ImgNo=$this->_post('id');
if($adclick->add()) {
$this->success("ok");
} else {
$this->error("no");
}
}
public function update() {
$adUrl=D("Adurl");
$adUrl->create();
if($adUrl->save()!=false) {
$this->success("更新成功");
} else {
$this->error("更新失败");
}
}
//获取广告信息
public function getAdInfo() {
$map['id']=$this->_post('id');
$adUrl=D("Adurl");
$data=$adUrl->where($map)->find();
if($data) {
$this->ajaxReturn($data,'',1);
} else {
$this->ajaxReturn(null,'没有此广告信息',0);
}
}
public function getClickInfo() {
$map['ImgNo']=$this->_post('id');
$adclick=D("Adclick");
$data=$adclick->where($map)->select();
if($data) {
$this->ajaxReturn($data,'',1);
} else {
$this->ajaxReturn(null,'没有此广告信息',0);
}
}
public function del() {
$map['id']=$this->_post('id');
$adUrl=M("Adurl");
if($adUrl->where($map)->delete()) {
$this->success("广告删除成功");
} else {
$this->error(null,"广告删除失败");
}
}
public function show() {
$adUrl=D("Adurl");
$list=$adUrl->showInfo();
$this->assign("list",$list);
$this->display();
}
public function uploadtTofile() {
$upload=new UploadAction('./Upload/'.MODULE_NAME.'/','uniqid','/Upload/'.MODULE_NAME.'/');
$upload->ajaxupload();
}
}
?>