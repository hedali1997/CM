<?php
require_once '../inc/function.php';

if(empty($_GET['name'])){
    if(empty($_GET['phone'])){
    exit('缺少必要参数');
    }
}
if(isset($_GET['name'])){
    $name=u_g($_GET['name']);
    //select 会员卡金额变动明细表.日期,会员库.姓名,会员库.手机号码,会员库.出生年月,会员卡金额变动明细表.发生金额,会员卡金额变动明细表.变动类型 from 会员卡金额变动明细表 inner join 会员库 on 会员卡金额变动明细表.会员编号=会员库.序号  where 会员卡金额变动明细表.会员编号='0d0abd64-239c-4017-8e89-98ca9bc5da8b' order by 会员卡金额变动明细表.日期 desc
    $res=cm_fetch_all("select ".u_g('会员卡金额变动明细表').".".u_g('日期').",".u_g('会员库').".".u_g('姓名').",".u_g('会员库').".".u_g('手机号码').",".u_g('会员库').".".u_g('出生年月').",".u_g('会员卡金额变动明细表').".".u_g('发生金额').",".u_g('会员卡金额变动明细表').".".u_g('变动类型')." from ".u_g('会员卡金额变动明细表')." inner join ".u_g('会员库')." on ".u_g('会员卡金额变动明细表').".".u_g('会员编号')."=".u_g('会员库').".".u_g('序号')."  where ".u_g('会员库').".".u_g('姓名')."='{$name}' order by ".u_g('会员卡金额变动明细表').".".u_g('日期')." desc;");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo date_format($item[u_g('日期')],"Y-m-d h:i:s").','.$item[u_g('姓名')].','.$item[u_g('手机号码')].','.date_format($item[u_g('出生年月')],"Y-m-d").','.$item[u_g('发生金额')].','.$item[u_g('变动类型')].'|';
    }
}
if(isset($_GET['phone'])){
    $phone=u_g($_GET['phone']);
    $res=cm_fetch_all("select ".u_g('会员卡金额变动明细表').".".u_g('日期').",".u_g('会员库').".".u_g('姓名').",".u_g('会员库').".".u_g('手机号码').",".u_g('会员库').".".u_g('出生年月').",".u_g('会员卡金额变动明细表').".".u_g('发生金额').",".u_g('会员卡金额变动明细表').".".u_g('变动类型')." from ".u_g('会员卡金额变动明细表')." inner join ".u_g('会员库')." on ".u_g('会员卡金额变动明细表').".".u_g('会员编号')."=".u_g('会员库').".".u_g('序号')."  where ".u_g('会员库').".".u_g('手机号码')."='{$phone}' order by ".u_g('会员卡金额变动明细表').".".u_g('日期')." desc;");
    if(!$res){
    die( print_r( sqlsrv_errors(), true));
    exit('查询失败1');
    }
    foreach ($res as $item) {
        echo date_format($item[u_g('日期')],"Y-m-d h:i:s").','.$item[u_g('姓名')].','.$item[u_g('手机号码')].','.date_format($item[u_g('出生年月')],"Y-m-d").','.$item[u_g('发生金额')].','.$item[u_g('变动类型')].'|';
    }
}
