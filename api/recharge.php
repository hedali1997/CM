<?php
require_once '../inc/function.php';

if(empty($_GET['name'])){
    if(empty($_GET['phone'])){
    exit('缺少必要参数');
    }
}
if(isset($_GET['name'])){
    $name=u_g($_GET['name']);
    $res=cm_fetch_one("select ".u_g('序号').",".u_g('姓名').",".u_g('手机号码').",".u_g('卡余额')." from ".u_g('会员库')." where ".u_g('姓名')."= '{$name}' ;");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    echo $res[u_g('序号')].','.$res[u_g('姓名')].','.$res[u_g('手机号码')].','.$res[u_g('卡余额')];
}
if(isset($_GET['phone'])){
    $phone=$_GET['phone'];
    $res=cm_fetch_one("select ".u_g('序号').",".u_g('姓名').",".u_g('手机号码').",".u_g('卡余额')." from ".u_g('会员库')." where ".u_g('手机号码')."= '{$phone}' ;");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败2');
    }
    echo $res[u_g('序号')].','.$res[u_g('姓名')].','.$res[u_g('手机号码')].','.$res[u_g('卡余额')];
}
