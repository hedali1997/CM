<?php
require_once '../inc/function.php';

if(empty($_GET['member']) || empty($_GET['card'])){
    exit('缺少必要参数');
}
$member=u_g($_GET['member']);
$card=u_g($_GET['card']);
// update 商品表 set 会员打折=@会员打折,充值卡打折=@充值卡打折
// update 商品表 set 会员销售价=销售价*会员打折
// update 商品表 set 充值卡售价=销售价*充值卡打折
$rows1=cm_execute("update 商品表 set 会员打折=@会员打折,充值卡打折=@充值卡打折");
$rows2=cm_execute("update 商品表 set 会员销售价=销售价*会员打折");
$rows3=cm_execute("update 商品表 set 充值卡售价=销售价*充值卡打折");
if($rows1< 1 || $rows1< 1 || $rows1< 1) exit('更新失败');
echo true;