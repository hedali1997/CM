<?php
require_once '../inc/function.php';

if(empty($_GET['start']) || empty($_GET['end'])){
    exit('缺少必要参数');
}
$start=u_g($_GET['start']);
$end=u_g($_GET['end']);

$res=cm_fetch_all('select '.u_g('销售明细表').'.'.u_g('日期').','.u_g('商品表').'.'.u_g('商品种类').','.u_g('商品表').'.'.u_g('厂家').','.u_g('商品表').'.'.u_g('型号').','.u_g('商品表').'.'.u_g('颜色').','.u_g('商品表').'.'.u_g('尺码').','.u_g('商品表').'.'.u_g('材质').','.u_g('销售明细表').'.'.u_g('销售姓名').','.u_g('销售明细表').'.'.u_g('折后价').','.u_g('销售明细表').'.'.u_g('是否退货').','.u_g('销售明细表').'.'.u_g('销售方式').' from '.u_g('销售明细表').' inner join '.u_g('商品表').' on '.u_g('商品表').'.'.u_g('商品序号').'='.u_g('销售明细表').'.'.u_g('商品序号').' where '.u_g('日期').">='{$start}' and ".u_g('日期')."<='{$end}' order by ".u_g('日期').' desc;');

// 销售数量
$sell_count=cm_fetch_one('select count(1) as num from '.u_g('销售记录').' where '.u_g('日期').">='{$start}' and ".u_g('日期')."<='{$end}';")['num'];

// 退货数量
$return_count=cm_fetch_one("select count(1) as num from ".u_g('销售明细表')." where ".u_g('是否退货')."='".u_g('是')."' and ".u_g('日期').">='{$start}' and ".u_g('日期')."<='{$end}';")['num'];

// 销售金额
$sell_amount=cm_fetch_one('select sum('.u_g('收款金额').') as sum from '.u_g('销售记录').' where '.u_g('日期').">='{$start}' and ".u_g('日期')."<='{$end}';")['sum'];

if(!$res || $sell_count===null || $return_count===null || $sell_amount===null){
die( print_r( sqlsrv_errors(), true));
exit('查询失败1');
}
foreach ($res as $item){
    echo $sell_count.','.$return_count.','.$sell_amount.','.date_format($item[u_g('日期')],"Y-m-d h:i:s").','.$item[u_g('商品种类')].','.$item[u_g('厂家')].','.$item[u_g('型号')].','.$item[u_g('颜色')].','.$item[u_g('尺码')].','.$item[u_g('材质')].','.$item[u_g('销售姓名')].','.$item[u_g('折后价')].','.$item[u_g('是否退货')].','.$item[u_g('销售方式')].'|';
}
